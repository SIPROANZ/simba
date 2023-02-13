<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('requisicion_id') }}
            {{ Form::text('requisicion_id', $requidetbo->requisicion_id, ['class' => 'form-control' . ($errors->has('requisicion_id') ? ' is-invalid' : ''), 'placeholder' => 'Requisicion Id']) }}
            {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('poa_id') }}
            {{ Form::text('poa_id', $requidetbo->poa_id, ['class' => 'form-control' . ($errors->has('poa_id') ? ' is-invalid' : ''), 'placeholder' => 'Poa Id']) }}
            {!! $errors->first('poa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('meta_id') }}
            {{ Form::text('meta_id', $requidetbo->meta_id, ['class' => 'form-control' . ($errors->has('meta_id') ? ' is-invalid' : ''), 'placeholder' => 'Meta Id']) }}
            {!! $errors->first('meta_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('financiamiento_id') }}
            {{ Form::text('financiamiento_id', $requidetbo->financiamiento_id, ['class' => 'form-control' . ($errors->has('financiamiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Financiamiento Id']) }}
            {!! $errors->first('financiamiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bos_id') }}
            {{ Form::text('bos_id', $requidetbo->bos_id, ['class' => 'form-control' . ($errors->has('bos_id') ? ' is-invalid' : ''), 'placeholder' => 'Bos Id']) }}
            {!! $errors->first('bos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('undmedida_id') }}
            {{ Form::text('undmedida_id', $requidetbo->undmedida_id, ['class' => 'form-control' . ($errors->has('undmedida_id') ? ' is-invalid' : ''), 'placeholder' => 'Undmedida Id']) }}
            {!! $errors->first('undmedida_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('claspres') }}
            {{ Form::text('claspres', $requidetbo->claspres, ['class' => 'form-control' . ($errors->has('claspres') ? ' is-invalid' : ''), 'placeholder' => 'Claspres']) }}
            {!! $errors->first('claspres', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $requidetbo->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $requidetbo->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>