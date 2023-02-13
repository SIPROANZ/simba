<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
        <div class="form-group">
            
            {{ Form::hidden('modificacion_id', $modificacion_id, ['class' => 'form-control' . ($errors->has('modificacion_id') ? ' is-invalid' : ''), 'placeholder' => 'Modificacion Id']) }}
            {!! $errors->first('modificacion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Select Dinamicos -->

        <div class="col-md-4">
        <div class="form-group">
        <label for="unidadadministrativa_id">Unidad Administrativa</label>
        <select name="unidadadministrativa_id" id="_unidadadministrativa" class="form-control">
              <option value="">Seleccione una opcion</option>
            @foreach ($unidades as $item)
            <option value="{{$item->id}}">{{$item->unidadejecutora}}</option>
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

        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('monto acredita') }}
            {{ Form::text('montoacredita', $detallesmodificacione->montoacredita, ['class' => 'form-control' . ($errors->has('montoacredita') ? ' is-invalid' : ''), 'placeholder' => 'Montoacredita']) }}
            {!! $errors->first('montoacredita', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('monto debita') }}
            {{ Form::text('montodebita', $detallesmodificacione->montodebita, ['class' => 'form-control' . ($errors->has('montodebita') ? ' is-invalid' : ''), 'placeholder' => 'Montodebita']) }}
            {!! $errors->first('montodebita', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>