<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

        <div class="col-md-8"> 
        <div class="form-group">
            {{ Form::label('Cuenta') }}
            {{ Form::text('cuenta', $clasificadorpresupuestario->cuenta, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Cuenta']) }}
            {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Denominacion') }}
            {{ Form::text('denominacion', $clasificadorpresupuestario->denominacion, ['class' => 'form-control' . ($errors->has('denominacion') ? ' is-invalid' : ''), 'placeholder' => 'Denominacion']) }}
            {!! $errors->first('denominacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>
             
    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>