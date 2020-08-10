<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>문제 업로드</h2></div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
                {{ Session::get('image') }} 업로드 성공 <br/>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>업로드 실패</strong> 사진 용량이 너무 큽니다. 저화질 사진으로 업로드해주세요.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('upload_question') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>문제 이미지: <input type="file" name="question_image" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>정답: <input type="number" name="correct_answer" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>풀이 이미지: <input type="file" name="solution_image" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>과목: </label>
                        <select name="subject">
                            <option value="물리1">물리1</option>
                            <option value="화학1">화학1</option>
                            <option value="생물1">생물1</option>
                            <option value="지구과학1">지구과학1</option>
                        </select>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>문제 출처: <input type="text" name="source_of_question" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>문제 번호: <input type="number" name="question_number" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <label>배점: <input type="number" name="score" class="form-control"></label>
                    </div>
                    <br/>

                    <div class="col-md-6">
                        (단순 암기문제인지 계산문제인지)
                    </div>
                    <br/>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">등록</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
