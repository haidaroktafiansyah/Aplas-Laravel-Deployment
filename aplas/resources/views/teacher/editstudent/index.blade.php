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
                                <img class="card-img-top"
                                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $entity['name'] }}</h5>
                                    <p class="card-text">{{ $entity['email'] }}</p>
                                    <p class="card-text">Student Status : {{ $entity['status'] }}</p>
                                    <p class="card-text"></p>
                                    <a href="{{ URL::to('teacher/member') }}" class="btn btn-primary">back to student
                                        List</a>
                                </div>
                            </div>
                        @endforeach
                        {{ Form::open(['route' => 'assignstudent.store', 'files' => true]) }}
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div id="alert-msg" class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="input-group">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i>Validate as
                                            Member of </button>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group-text">Class</div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::select('classroom', $classroom, null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
