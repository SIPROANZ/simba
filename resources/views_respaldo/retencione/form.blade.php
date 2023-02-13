<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Descripcion') }}
                    {{ Form::text('descripcion', $retencione->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Porcentaje') }}
                    {{ Form::text('porcentaje', $retencione->porcentaje, ['class' => 'form-control' . ($errors->has('porcentaje') ? ' is-invalid' : ''), 'placeholder' => 'Porcentaje']) }}
                    {!! $errors->first('porcentaje', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Tipo de Deducción') }}
                    {{ Form::select('tipo', [ 'I' => 'Impuesto', 'R' => 'Retención' ] , $retencione->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese un Tipo']) }}
                    {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Tipo de Retencion') }}
                    {{ Form::select('tiporetencion_id', $tiporetencion, $retencione->tiporetencion_id, ['class' => 'form-control' . ($errors->has('tiporetencion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese un Tipo']) }}
                    {!! $errors->first('tiporetencion_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Base de Calculo') }}
                    {{ Form::select('base_calculo', [ '1' => 'Base Imponible', '2' => 'I.V.A.' ] , $retencione->base_calculo, ['class' => 'form-control' . ($errors->has('base_calculo') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese una Base de Calculo']) }}
                    {!! $errors->first('base_calculo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

