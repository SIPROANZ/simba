<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nombre', $estado->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Nombre del Estado']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Codigo Onapre') }}
            {{ Form::text('codigoonapre', $estado->codigoonapre, ['class' => 'form-control' . ($errors->has('codigoonapre') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Onapre']) }}
            {!! $errors->first('codigoonapre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>