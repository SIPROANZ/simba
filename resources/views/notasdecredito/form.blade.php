<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('Descripcion') }}
                <textarea class="ckeditor form-control" name="descripcion">{{ $notasdecredito->descripcion }}</textarea>
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $notasdecredito->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('institucion') }}
            {{ Form::select('institucion_id',$instituciones, $notasdecredito->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('beneficiario') }}
            {{ Form::select('beneficiario_id', $beneficiarios, $notasdecredito->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

      <!--  <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('banco') }}
            {{ Form::text('banco_id', $notasdecredito->banco_id, ['class' => 'form-control' . ($errors->has('banco_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('banco_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('cuentabancaria') }}
            {{ Form::text('cuentabancaria_id', $notasdecredito->cuentabancaria_id, ['class' => 'form-control' . ($errors->has('cuentabancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('cuentabancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div> -->


        <!-- Select Dinamicos -->

        <div class="col-md-3">
        <div class="form-group">
        <label for="banco_id">Bancos</label>
        <select name="banco_id" id="_bancos" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($bancos as $item)
            <option value="{{$item->id}}">{{$item->denominacion}}</option>
            @endforeach
        </select>
        {!! $errors->first('banco_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
        <label for="requisicion_id">Cuentas Bancarias</label>
        <select name="cuentabancaria_id" id="_cuentas" class="form-control"></select>
        {!! $errors->first('cuentabancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>


        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $notasdecredito->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $notasdecredito->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>


        <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $notasdecredito->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>