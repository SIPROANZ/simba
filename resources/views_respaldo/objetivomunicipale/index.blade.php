@extends('layouts.app')

@section('template_title')
    Objetivomunicipale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetivo Municipales') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('objetivomunicipales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Nro</th>
                                        
										<th class="text-center">Objetivo Municipal</th>
										<th class="text-center">Objetivo</th>

                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetivomunicipales as $objetivomunicipale)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $objetivomunicipale->objetivomunicipal }}</td>
											<td class="text-center">{{ $objetivomunicipale->objetivo }}</td>

                                            <td class="text-center">
                                                <form action="{{ route('objetivomunicipales.destroy',$objetivomunicipale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('objetivomunicipales.show',$objetivomunicipale->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('objetivomunicipales.edit',$objetivomunicipale->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $objetivomunicipales->links() !!}
            </div>
        </div>
    </div>
@endsection
