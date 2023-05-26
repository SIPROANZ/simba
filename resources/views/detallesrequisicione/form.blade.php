<div class="box box-info padding-1">
    <div class="row">

 
  
        <div class="form-group">
            {{ Form::hidden('requisicion_id', session('requisicion'), ['class' => 'form-control' . ($errors->has('requisicion_id') ? ' is-invalid' : ''), 'placeholder' => 'Requisicion']) }}
            {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

        <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('bos') }}
            {{ Form::select('bos_id', $detallesbos, $detallesrequisicione->bos_id, ['class' => 'form-control' . ($errors->has('bos_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Bos']) }}
            {!! $errors->first('bos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $detallesrequisicione->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('financiamiento') }}
            {{ Form::select('financiamiento_id', $financiamientos, $detallesrequisicione->financiamiento_id, ['class' => 'form-control' . ($errors->has('bos_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Financiamiento']) }}
            {!! $errors->first('financiamiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button"><i class="spinner fas fa-spinner fa-spin"></i> Crear En Sistema </button>
    </div>
</div>