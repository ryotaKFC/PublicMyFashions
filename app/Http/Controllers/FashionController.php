<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fashion;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FashionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->query("sort", 'created_at');
        $direction = $request->query('direction', 'desc');

        $filter = $request->query('filter','');
        $filter_value = $request->query('filter_value', '');

        // ソート可能なカラムを制限
        $allowedSorts = ['created_at', 'season','weather','temperature','humidity'];
        $allowedDirections = ['asc', 'desc'];
        if (!in_array($sort, $allowedSorts)) $sort = 'created_at';
        if (!in_array($direction, $allowedDirections)) $direction = 'desc';

        $query = Fashion::query();
        if ($filter && $filter_value) {
            $query->where($filter, $filter_value);
        }
        $fashions = $query->orderBy($sort, $direction)->get();

        // return view('fashions.index', compact('fashions', 'sort', 'direction'));
        return view('fashions.index', [
            'fashions' => $fashions,
            'sort' => $sort,
            'direction' => $direction,
            'filter' => $filter,
            'filter_value' => $filter_value,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fashion = new Fashion();
        $data = ['fashion' => $fashion];
        return view('fashions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'season' => 'required|max:20',
            'weather' => 'required|max:20',
            'temperature' => 'required|max:3',
            'humidity' => 'required|max:3',
            'comment' => 'max:20',
        ]);
        if ($request->file('photo') == null) {
            $this->validate($request, ['photo_path' => 'required',]);
        }
        $fashion = new Fashion();
        $fashion->timestamps = false; // 明示的に自動更新を止める
        $fashion->created_at = Carbon::parse($request->created_at);
        $fashion->user_id = auth()->id();
        $fashion->season = $request->season;
        $fashion->weather = $request->weather;
        $fashion->temperature = $request->temperature;
        $fashion->humidity = $request->humidity;
        $fashion->luck = $this->get_random_luck();
        // コメント処理
        if($request->comment != '')
        $fashion->comment = $request->comment;
        else
        $fashion->comment = $this->get_random_comment();
        
        // 画像処理
        // name属性が'photo'のinputタグをファイル形式に、画像をpublic/avatarに保存
        $image_path = $request->file('photo')->store('public/avatar/');
        // 上記処理にて保存した画像に名前を付け、userテーブルのthumbnailカラムに、格納
        $fashion->photo_path = basename($image_path);
        $fashion->save();


        return redirect(route('fashions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fashion  $fashion
     * @return \Illuminate\Http\Response
     */
    public function show(Fashion $fashion)
    {
        $data = ['fashion' => $fashion];
        return view('fashions.show', data: $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fashion  $fashion
     * @return \Illuminate\Http\Response
     */
    public function edit(Fashion $fashion)
    {
        $this->authorize($fashion);
        $data = ['fashion' => $fashion];
        return view('fashions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fashion  $fashion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fashion $fashion)
    {
        $this->authorize($fashion);
        $this->validate($request, [
            'season' => 'required|max:20',
            'weather' => 'required|max:20',
            'temperature' => 'required|max:3',
            'humidity' => 'required|max:3',
            'comment' => 'max:20',

        ]);
        if ($request->file('photo') == null) {
            $this->validate($request, ['photo_path' => 'required',]);
        }
        $fashion = new Fashion();
        $fashion->season = $request->season;
        $fashion->weather = $request->weather;
        $fashion->temperature = $request->temperature;
        $fashion->humidity = $request->humidity;
        // コメント処理
        if($request->comment != '')
        $fashion->comment = $request->comment;
        else
        $fashion->comment = $this->get_random_comment();
        //　画像処理
        $image_path = $request->file('photo')->store('public/avatar/');
        $fashion->photo_path = basename($image_path);
        
        $fashion->save();

        return redirect(to: route('fashions.show', $fashion));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fashion  $fashion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fashion $fashion)
    {
        $this->authorize($fashion);
        $fashion->delete();
        return redirect(route('fashions.index'));
    }

    public function bookmark_fashions(Request $request){
        $fashions = \Auth::user()->bookmark_fashions()->orderBy('created_at', 'desc')->get();
        $data = [
            'fashions' => $fashions,
        ];

        return view('fashions.bookmarks', $data);
    }

    public function calendar_event_fetch(Request $request)
    {
        $userId = \Auth::id();

        $fashions = Fashion::where('user_id', $userId)->get();
        
        // created_at の日付ごとにグループ化して、各日からランダムで1件ずつ抽出
        $grouped = $fashions->groupBy(function ($item) {
            return $item->created_at->toDateString(); // 例: "2025-06-26"
        });

        // FullCalendar形式に変換
        $events = $grouped->map(function ($items) {
            $fashion = $items->random(); // 同じ日付内からランダムに1件
            return [
                'id' => $fashion->id,
                'title' => '',
                'start' => $fashion->created_at->toDateString(), 
                'image_url' => asset('storage/avatar/' . $fashion->photo_path),
                'url' => route('fashions.show', $fashion),
            ];
        })->values();

        return response()->json($events);
    }


    public function get_random_luck(){
        $luck_comment = [
            '大吉',
            'スーパー吉',
            '超吉',
            '神吉',
            'Nice吉',
        ];
        return $luck_comment[rand(0, count($luck_comment) - 1)];
    }
    public function get_random_comment(){
        $comment = [
            '服好きと繋がりたい',
            'テスト',
            'デート服',
            'カフェ巡り',
            'ChatGPT',
            'vacation',
            'にっこり',
            'えんじょい',
            '遠出',
            '日帰り',
            'ドラゴンボール',
            'すごろく',
        ];
        return $comment[rand(0, count($comment) - 1)];
    }
}
