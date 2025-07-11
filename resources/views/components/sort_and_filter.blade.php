
<form method="GET" action="{{ route('fashions.index') }}">
    <div class="sort-filter">
        <label for="sort">並び替え：</label>
        <select name="sort" id="sort">
            <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>作成日</option>
            <option value="season" {{ $sort === 'season' ? 'selected' : '' }}>季節</option>
            <option value="weather" {{ $sort === 'weather' ? 'selected' : '' }}>天気</option>
            <option value="temperature" {{ $sort === 'temperature' ? 'selected' : '' }}>気温</option>
            <option value="humidity" {{ $sort === 'humidity' ? 'selected' : '' }}>湿度</option>
        </select>
        <select name="direction" id="direction">
            <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>昇順</option>
            <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>降順</option>
        </select>
    </div>

    <div class="sort-filter">
        <label for="filter">フィルター：</label>
        <select name="filter" id="filter">
            <option value="">なし</option>
            <option value="season" {{ $filter === 'season' ? 'selected' : '' }}>季節</option>
            <option value="weather" {{ $filter === 'weather' ? 'selected' : '' }}>天気</option>
            <option value="temperature" {{ $filter === 'temperature' ? 'selected' : '' }}>気温</option>
            <option value="humidity" {{ $filter === 'humidity' ? 'selected' : '' }}>湿度</option>
            <option value="luck" {{ $filter === 'luck' ? 'selected' : '' }}>運勢</option>
            <option value="comment" {{ $filter === 'comment' ? 'selected' : '' }}>コメント</option>
        </select>
        <select name="filter_value" id="filter_value"></select>
    </div>
    <div class="sort-filter">
        <button type="submit" class="primary-color">検索</button>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterSelect = document.getElementById('filter');
        const valueSelect = document.getElementById('filter_value');

        const targetValuesName = {
            season: ['春', '夏', '秋', '冬'],
            weather: ['晴れ', '曇り', '雨', '雪'],
            temperature: ['0℃以下','5℃', '10℃', '15℃', '20℃', '25℃', '30℃', '35℃以上'],
            humidity: ['10%', '30%', '50%', '70%', '90%'],
            luck: ['大吉','スーパー吉','超吉','神吉','Nice吉'],
            comment: ['服好きと繋がりたい','テスト','デート服','カフェ巡り','ChatGPT','vacation','にっこり','えんじょい','遠出','日帰り','ドラゴンボール','すごろく',]
        };
        const targetValues = {
            season: ['春', '夏', '秋', '冬'],
            weather: ['晴れ', '曇り', '雨', '雪'],
            temperature: ['-1','5', '10', '15', '20', '25', '30', '35'],
            humidity: ['10', '30', '50', '70', '90'],
            luck: ['大吉','スーパー吉','超吉','神吉','Nice吉'],
            comment: ['服好きと繋がりたい','テスト','デート服','カフェ巡り','ChatGPT','vacation','にっこり','えんじょい','遠出','日帰り','ドラゴンボール','すごろく',]
        };

        function updateFilterOptions(selectedFilter, selectedValue = '') {
            valueSelect.innerHTML = '';
            if (targetValues[selectedFilter] && targetValuesName[selectedFilter]) {
                targetValues[selectedFilter].forEach(function (val, index) {
                    const option = document.createElement('option');
                    option.value = val;
                    option.textContent = targetValuesName[selectedFilter][index];
                    if (val === selectedValue) {
                        option.selected = true;
                    }
                    valueSelect.appendChild(option);
                });
            }
        }

        // 初期表示時に復元（PHPから渡された変数をJSで使う）
        const selectedFilter = "{{ $filter }}";
        const selectedValue = "{{ $filter_value }}";
        if (selectedFilter && targetValues[selectedFilter]) {
            updateFilterOptions(selectedFilter, selectedValue);
        }

        // フィルター選択時の動的更新
        filterSelect.addEventListener('change', function () {
            updateFilterOptions(this.value);
        });
    });
</script>

<style>
    /* 検索欄の整列 */
    .sort-filter {
        margin: 10px auto;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }
    /* フォームのスタイル */
    .sort-filter select{
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    /* 検索ボタンのスタイル */
    .sort-filter button {
        padding: 10px 20px;
        /* background-color: #0e4a12; */
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    #create-button a:hover {
        /* background-color:#777 ; ホバー時の色 */
    }
    
</style>
