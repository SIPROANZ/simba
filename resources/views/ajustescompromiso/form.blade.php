<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('Concepto') }}
                <textarea class="ckeditor form-control" name="concepto">{{ $ajustescompromiso->concepto }}</textarea>
                {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::select('tipo', ['1'=>'Aumenta', '2'=>'Disminuye'], $ajustescompromiso->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $ajustescompromiso->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
           
            {{ Form::hidden('compromiso_id', $compromiso->id, ['class' => 'form-control' . ($errors->has('compromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Compromiso Id']) }}
            {!! $errors->first('compromiso_id', '<div class="invalid-feedback">:message</div>') !!}
           
            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
       
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('monto ajuste') }}
            {{ Form::text('montoajuste', $ajustescompromiso->montoajuste, ['class' => 'form-control' . ($errors->has('montoajuste') ? ' is-invalid' : ''), 'placeholder' => 'Monto del ajuste']) }}
            {!! $errors->first('montoajuste', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>