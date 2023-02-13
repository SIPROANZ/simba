
<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
  <!-- Select Dinamicos -->

  <div class="col-md-4">
        <div class="form-group">
        <label for="unidadadministrativa_id">Unidad Administrativa</label>
        <select name="unidadadministrativa_id" id="_unidadadministrativa" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($unidades as $item)
            <option value="{{$item->id}}">{{$item->sector . '-' . $item->programa .'-' . $item->actividad . ' '. $item->unidadejecutora}}</option>
            @endforeach
        </select>
        {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
        <label for="requisicion_id">Requisicion</label>
        <select name="requisicion_id" id="_requisicion" class="form-control"></select>
        {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

       

        <!-- Fin de Codigo -->
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('criterio') }}
            {{ Form::select('criterio_id', $criterios, $analisi->criterio_id, ['class' => 'form-control' . ($errors->has('criterio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Criterio']) }}
            {!! $errors->first('criterio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>
        
        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('numero cotizacion') }}
            {{ Form::text('numeracion', $analisi->numeracion, ['class' => 'form-control' . ($errors->has('numeracion') ? ' is-invalid' : ''), 'placeholder' => '0']) }}
            {!! $errors->first('numeracion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('observacion') }}
            {{ Form::text('observacion', $analisi->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observacion']) }}
            {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('estatus', 'EP', ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $analisi->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
           
       
        </div>
        </div>

        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>










