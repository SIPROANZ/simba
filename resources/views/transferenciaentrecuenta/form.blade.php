<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">

        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('Descripcion') }}
                <textarea class="ckeditor form-control" name="descripcion">{{ $transferenciaentrecuenta->descripcion }}</textarea>
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-md-3">
        
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $transferenciaentrecuenta->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $transferenciaentrecuenta->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">


            
        <div class="form-group">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $transferenciaentrecuenta->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

       
<!--
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco origen') }}
            {{ Form::text('bancoorigen_id', $transferenciaentrecuenta->bancoorigen_id, ['class' => 'form-control' . ($errors->has('bancoorigen_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('bancoorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cuenta origen') }}
            {{ Form::text('cuentaorigen_id', $transferenciaentrecuenta->cuentaorigen_id, ['class' => 'form-control' . ($errors->has('cuentaorigen_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('cuentaorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        BANCO DESTINO
-->

<!-- Select Dinamicos -->

        <div class="col-md-3">
        <div class="form-group">
        <label for="banco_id">Banco Origen</label>
        <select name="bancoorigen_id" id="_bancosorigen" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($bancos as $item)
            <option value="{{$item->id}}">{{$item->denominacion}}</option>
            @endforeach
        </select>
        {!! $errors->first('bancoorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
        <label for="requisicion_id">Cuentas Origen</label>
        <select name="cuentaorigen_id" id="_cuentasorigen" class="form-control"></select>
        {!! $errors->first('cuentaorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <!--
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco destino') }}
            {{ Form::text('bancodestino_id', $transferenciaentrecuenta->bancodestino_id, ['class' => 'form-control' . ($errors->has('bancodestino_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('bancodestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cuenta destino') }}
            {{ Form::text('cuentadestino_id', $transferenciaentrecuenta->cuentadestino_id, ['class' => 'form-control' . ($errors->has('cuentadestino_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('cuentadestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        -->

        <div class="col-md-3">
        <div class="form-group">
        <label for="banco_id">Banco Destino</label>
        <select name="bancodestino_id" id="_bancosdestino" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($bancosdestino as $item)
            <option value="{{$item->id}}">{{$item->denominacion}}</option>
            @endforeach
        </select>
        {!! $errors->first('bancodestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
        <label for="requisicion_id">Cuentas Destino</label>
        <select name="cuentadestino_id" id="_cuentasdestino" class="form-control"></select>
        {!! $errors->first('cuentadestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
    </div>
</div>