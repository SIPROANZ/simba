<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('montocompromiso') }}
            {{ Form::text('montocompromiso', $detallesprecompromiso->montocompromiso, ['class' => 'form-control' . ($errors->has('montocompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Montocompromiso']) }}
            {!! $errors->first('montocompromiso', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('precompromiso_id', 0, ['class' => 'form-control' . ($errors->has('precompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Precompromiso Id']) }}
            {!! $errors->first('precompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        
        </div>
        </div>


        <!-- Select Dinamicos -->

        <div class="col-md-4">
        <div class="form-group">
        <label for="unidadadministrativa_id">Unidad Administrativa</label>
        <select name="unidadadministrativa_id" id="_unidadadministrativa" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($unidades as $item)
            <option value="{{$item->id}}">{{$item->sector . '.'. $item->programa . '.'. $item->subprograma . '.'. $item->proyecto . '.'. $item->actividad . ' '. $item->unidadejecutora}}</option>
            @endforeach
        </select>
        {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
        <label for="requisicion_id">Clasificador Presupuestario</label>
        <select name="ejecucion_id" id="_ejecucion" class="form-control"></select>
        {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

       
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>