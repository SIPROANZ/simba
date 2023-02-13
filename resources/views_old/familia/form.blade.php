<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Codigo') }}
                    {{ Form::text('codigofamilia', $familia->codigofamilia, ['class' => 'form-control' . ($errors->has('codigofamilia') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Codigo']) }}
                    {!! $errors->first('codigofamilia', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Nombre') }}
                    {{ Form::text('nombre', $familia->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Segmento de BOS') }}
                    {{ Form::select('segmento_id', $segmento, $familia->segmento_id, ['class' => 'form-control' . ($errors->has('segmento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Segmento']) }}
                    {!! $errors->first('segmento_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
