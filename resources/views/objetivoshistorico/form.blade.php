<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Objetivo Historico') }}
            {{ Form::textarea('objetivo', $objetivoshistorico->objetivo, ['class' => ' ckeditor form-control' . ($errors->has('objetivo') ? ' is-invalid' : ''), 'placeholder' => 'Ingresar Objetivo Historico']) }}
            {!! $errors->first('objetivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>
