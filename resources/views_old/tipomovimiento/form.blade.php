<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Movimiento bancario') }}
            {{ Form::text('descripcion', $tipomovimiento->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Accion') }}
            {{ Form::text('accion', $tipomovimiento->accion, ['class' => 'form-control' . ($errors->has('accion') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el tipo']) }}
            {!! $errors->first('accion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>