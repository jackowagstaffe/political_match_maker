@extends('base')
@section('main-content')
    <h1>Policies by category</h1>

    @foreach($sets as $key => $value)
        <div class="panel panel-default">
            <div class="panel-heading lead">
                {{ $key }}
            </div>
            <table class="table">
                <tr>
                    <th>
                        Number
                    </th>
                    <th>
                        Text
                    </th>
                </tr>
                @foreach($value as $policy)
                    <tr>
                        <td>
                            {{ $policy->number }}
                        </td>
                        <td>
                            {!! $policy->text !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach
@stop
