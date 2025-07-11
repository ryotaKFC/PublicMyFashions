@csrf 
<dl class="form-list">
    <img id="preview" style="max-width: 200px; display: none;" />
    <dt>写真</dt>
    <dd><input type="file" name="photo" id="photoInput" accept="image/*"></dd>
    <dt>季節</dt>
    <dd>
      <select name="season">
          <option value="">選択してください</option>
          @foreach (['春', '夏', '秋', '冬'] as $option)
              <option value="{{ $option }}" {{ old('season') == $option ? 'selected' : '' }}>{{ $option }}</option>
          @endforeach
      </select>
    </dd>
    <dt>天気</dt>
    <dd>
      <select name="weather">
        <option value="">選択してください</option>
        @foreach (['晴れ', '曇り', '雨', '雪'] as $option)
            <option value="{{ $option }}" {{ old('weather') == $option ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
      </select>
    </dd>
    <dt>温度</dt>
    <dd>
      <select name="temperature">
        <option value="">選択してください</option>
        <option value="-1" {{ old('temperature') == -1 ? 'selected' : '' }}>0℃以下</option>
        <option value="5"  {{ old('temperature') == 5  ? 'selected' : '' }}>5℃</option>
        <option value="10" {{ old('temperature') == 10 ? 'selected' : '' }}>10℃</option>
        <option value="15" {{ old('temperature') == 15 ? 'selected' : '' }}>15℃</option>
        <option value="20" {{ old('temperature') == 20 ? 'selected' : '' }}>20℃</option>
        <option value="25" {{ old('temperature') == 25 ? 'selected' : '' }}>25℃</option>
        <option value="30" {{ old('temperature') == 30 ? 'selected' : '' }}>30℃</option>
        <option value="35" {{ old('temperature') == 35 ? 'selected' : '' }}>35℃以上</option>
      </select>
    </dd>
    <dt>湿度</dt>
    <dd>
      <select name="humidity">  
        <option value="">選択してください</option>
        <option value="10" {{ old('humidity') == 10 ? 'selected' : '' }}>10%</option>
        <option value="30" {{ old('humidity') == 30 ? 'selected' : '' }}>30%</option>
        <option value="70" {{ old('humidity') == 50 ? 'selected' : '' }}>50%</option>
        <option value="70" {{ old('humidity') == 70 ? 'selected' : '' }}>70%</option>
        <option value="90" {{ old('humidity') == 90 ? 'selected' : '' }}>90%</option>
      </select>
    </dd>
    <dt>日付</dt>
    <dd>
      <input type="date" name="created_at" value="{{ old('created_at') ?: \Carbon\Carbon::today()->format('Y-m-d') }}">
    </dd>
</dl>

<script>
  document.getElementById('photoInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        const preview = document.getElementById('preview');
        preview.src = event.target.result;
        preview.style.display = 'block';
      };

      reader.readAsDataURL(file);
    }
  });
</script>
<style>
/* フォーム全体 */
.form-list {
  display: inline-block;
  background-color: #e6f4ff;
  padding: 30px;
  border-radius: 20px;
  /* box-shadow: 0 0 10px #a3d8ff; */
  text-align: left;
  margin-bottom: 40px;
}

.form-list dt {
  font-weight: bold;
  margin-top: 15px;
  color: #1a73e8;
}

.form-list dd {
  margin-bottom: 10px;
}

input[type="file"],
input[type="number"],
input[type="date"],
select {
  width: 100%;
  padding: 6px 12px;
  border-radius: 10px;
  border: 1px solid #bbb;
  background: #fff;
  font-size: 1em;
  box-sizing: border-box;
  margin: 5px 0 10px;
}

/* プレビュー画像 */
#preview {
  display: block;
  margin: 0 auto 20px;
  border-radius: 10px;
  box-shadow: 0 0 8px #7bbfff;
}

/* ボタンエリア */
.form-buttons {
  text-align: right;
  margin-top: 25px;
  padding-right: 10px;
}

/* 送信ボタン */
.form-buttons input[type="submit"] {
  background-color: #1e3a8a;
  color: white;
  font-weight: bold;
  font-size: 1rem;
  padding: 12px 25px;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-buttons input[type="submit"]:hover {
  background-color: #162d6d;
  transform: translateY(-2px);
}

/* リンクボタン */
.form-buttons a {
  margin-left: 15px;
  padding: 8px 16px;
  border-radius: 20px;
  background-color: #e0f0ff;
  color: #007acc;
  font-weight: bold;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.form-buttons a:hover {
  background-color: #c0e0ff;
}
</style>
