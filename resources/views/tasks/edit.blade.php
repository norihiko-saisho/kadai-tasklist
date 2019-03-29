@extends('layouts.app')

@section('content')

    <h1>id: {{ $Task->id }} の編集ページ</h1>
    
    {!! Form::model($Task, ['route' => ['tasks.update', $Task->id], 'method' => 'put']) !!}

    <div class="row">
        <div class="col-6">
            {!! Form::model($Task, ['route' => ['tasks.update', $Task->id], 'method' => 'put']) !!}
        
                <div class="form-group">
                    {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'タスク内容:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
        
                {!! Form::submit('更新', ['class' => 'btn btn-light']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>

@endsection