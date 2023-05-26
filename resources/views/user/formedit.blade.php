<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre de Usuario') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       

        @foreach ($roles as $rol)
        <div class="form-group">
            {{-- Form::label('email') --}}
            {{ Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) }}
            {{ $rol->name }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @endforeach

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>