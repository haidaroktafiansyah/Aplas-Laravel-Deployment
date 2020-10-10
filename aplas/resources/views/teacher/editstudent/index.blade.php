@extends('teacher/home')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Of Student</h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                        <div id="alert-msg" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($entity as $entity)
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $entity['name'] }}</h5>
                                    <p class="card-text">{{ $entity['email'] }}</p>
                                    <p class="card-text">{{ $entity['status'] }}</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                            {{-- <tr>
                                <td>{{ $entity['name'] }}</td>
                                <td>{{ $entity['email'] }}</td>
                                <td>{{ $entity['count'] == '' ? 0 : $entity['count'] }} topic(s)</td>
                                <td>{{ $entity['topicname'] == '' ? '-' : $entity['topicname'] }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if ($entity['count'] == '')
                                            <form method="POST" action="{{ URL::to('/teacher/member/' . $entity['id']) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash">&nbsp;</i>Delete this Student</button>
                                                </div>
                                            </form>
                                        @else
                                            <a class="btn btn-success"
                                                href="{{ URL::to('/teacher/member/' . $entity['id'] . '/edit') }}"><i
                                                    class="fa fa-check-circle"></i>&nbsp;Show Student Result</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center"><a href="/teacher/studentdet/{{ $entity['name'] }}"
                                        class="btn btn-info">Detail</a></td>
                            </tr> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
