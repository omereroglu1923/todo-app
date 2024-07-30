@extends('layout.master')
@section('content')
    <div class="row my-5">
        <div class="col-xl-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Todo Detay Sayfası</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">TODO TITLE</label>
                        <input type="text" class="form-control" name="title" value="{{$todo->title}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TODO AÇIKLAMA</label>
                        <textarea class="form-control" name="description" readonly>{{$todo->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TODO Yapılı mı?</label>
                        <select class="form-control" name="completed" readonly>
                            <option value="1" @if($todo->completed == 1) selected @endif>Evet</option>
                            <option value="0" @if($todo->completed == 0) selected @endif>Hayır</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

