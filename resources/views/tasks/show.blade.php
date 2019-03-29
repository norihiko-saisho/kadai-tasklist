@extends('layouts.app')

@section('content')

    <h1>id = {{ $Task->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $Task->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $Task->status }}</td>
        </tr>
        <tr>
            <th>タスク内容</th>
            <td>{{ $Task->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $Task->id], ['class' => 'btn btn-primary']) !!}

    {!! Form::model($Task, ['route' => ['tasks.destroy', $Task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection