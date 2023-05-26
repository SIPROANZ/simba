<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
            <div class="form-group">
                {{-- Form::label('N° Compromiso') --}}
                {{ Form::hidden('compromiso_id',0, ['class' => 'form-control' . ($errors->has('compromiso_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('compromiso_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('Beneficiario') }}
                {{ Form::select('beneficiario_id', $beneficiarios, $ordenpago->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('Tipo orden') }}
                {{ Form::select('tipoorden',  ['2' => 'Sin Imputacion' ], $ordenpago->tipoorden, ['class' => 'form-control' . ($errors->has('tipoorden') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione']) }}
                {!! $errors->first('tipoorden', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto base') }}
            {{ Form::text('montobase', $ordenpago->montobase, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('Monto IVA') }}

                {{ Form::text('montoiva', $ordenpago->montoiva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto Retencion') }}
            {{ Form::text('montoretencion', $ordenpago->montoretencion, ['class' => 'form-control' . ($errors->has('montoretencion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoretencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('Monto exento') }}
                {{ Form::text('montoexento', $ordenpago->montoexento, ['class' => 'form-control' . ($errors->has('montoexento') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('montoexento', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('Monto neto') }}

                
                {{ Form::text('montoneto', $ordenpago->montoneto, ['class' => 'form-control' . ($errors->has('montoneto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
              
          

                {!! $errors->first('montoneto', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $ordenpago->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
           
       
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Numero Orden Pago') }}
            {{ Form::text('nordenpago', $ordenpago->nordenpago, ['class' => 'form-control' . ($errors->has('nordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Numero de Orden de Pago']) }}
            {!! $errors->first('nordenpago', '<div class="invalid-feedback">:message</div>') !!}
        
            </div>
        </div>

        <div class="form-group">
            {{ Form::hidden('montoretencion', $ordenpago->montoretencion, ['class' => 'form-control' . ($errors->has('montoretencion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoretencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        
{{--         <div class="form-group">
            {{ Form::hidden('status', 'EP', $ordenpago->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
 --}}


</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>