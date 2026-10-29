<!DOCTYPE html>
<html lang="en">
<head>
  @include('asociados.header')
  <title>{{GetSiglas(2)}} | Generador</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')
<div class="wrapper">

  @include('asociados.navbar')

  <div class="content-wrapper">
    <div class="content-header">&nbsp;</div>

    <section class="content">
        @include('asociados.sidebar')
        <div class="container-fluid">

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('generadores.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Regresar
                </a>
            </div>

            @if($generador->verificado==0)
                <div class="card card-default">
            @else
                <div class="card card-success">
            @endif

                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-industry title-icon" aria-hidden="true"></i> Generador</h3>
                </div>

                <form action="{{ route('generadores.update', $generador->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="card card-primary" id="fiscales">
                            <div class="card-header">
                                <h3 class="card-title">Datos Generador</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="razonsocial">Denominación/Razón social</label>
                                    <input type="text" name="razonsocial" class="form-control" id="razonsocial" maxlength="250" value="{{$generador->razonsocial}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fisicaomoral">Persona</label>
                                            <select name="fisicaomoral" id="fisicaomoral" class="form-control" onchange="togglePersona()">
                                                <option value="Física" {{ $generador->fisicaomoral == 'Física' ? 'selected' : '' }}>Física</option>
                                                <option value="Moral" {{ $generador->fisicaomoral == 'Moral' ? 'selected' : '' }}>Moral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input type="text" name="rfc" class="form-control" id="rfc" maxlength="50" value="{{$generador->rfc}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="rfcpdf">RFC (PDF)</label>
                                    <input type="file" name="rfcpdf" class="form-control" id="rfcpdf" accept="application/pdf">
                                    @if($generador->rfcpdf)
                                        <a href="{{ asset('documentos/generadores/rfc/empresa/'.$generador->rfcpdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                            <i class="fa fa-file-pdf"></i> Ver actual
                                        </a>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" name="calle" class="form-control" id="calle" maxlength="500" value="{{$generador->calle}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="numeroext">Número ext.</label>
                                            <input type="text" name="numeroext" class="form-control" id="numeroext" maxlength="20" value="{{$generador->numeroext}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="numeroint">Número int.</label>
                                            <input type="text" name="numeroint" class="form-control" id="numeroint" maxlength="20" value="{{$generador->numeroint}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input type="text" name="colonia" class="form-control" id="colonia" maxlength="250" value="{{$generador->colonia}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <input type="text" name="entidad" class="form-control" id="entidad" maxlength="100" value="{{$generador->entidad}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Municipio</label>
                                            <input type="text" name="municipio" class="form-control" id="municipio" maxlength="150" value="{{$generador->municipio}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cp">CP</label>
                                            <input type="text" name="cp" class="form-control" id="cp" maxlength="20" value="{{$generador->cp}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" maxlength="50" value="{{$generador->telefono}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="text" name="celular" class="form-control" id="celular" maxlength="50" value="{{$generador->celular}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input type="text" name="mail" class="form-control" id="mail" maxlength="150" value="{{$generador->mail}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail2">Correo</label>
                                            <input type="text" name="mail2" class="form-control" id="mail2" maxlength="150" value="{{$generador->mail2}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="bloqueMoral" style="{{ $generador->fisicaomoral == 'Moral' ? '' : 'display:none;' }}">
                            <div class="card card-primary" id="representante">
                                <div class="card-header">
                                    <h3 class="card-title">Representante legal</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombresrepre">Nombre(s)</label>
                                                <input type="text" name="nombresrepre" class="form-control" id="nombresrepre" maxlength="150" value="{{$generador->nombresrepre}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidosrepre">Apellidos</label>
                                                <input type="text" name="apellidosrepre" class="form-control" id="apellidosrepre" maxlength="150" value="{{$generador->apellidosrepre}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nacionalidadrepre">Nacionalidad</label>
                                                <input type="text" name="nacionalidadrepre" class="form-control" id="nacionalidadrepre" maxlength="100" value="{{$generador->nacionalidadrepre}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="identificacionrepre">Identificación</label>
                                                <input type="text" name="identificacionrepre" class="form-control" id="identificacionrepre" value="{{$generador->identificacionrepre}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rfcrepre">RFC</label>
                                                <input type="text" name="rfcrepre" class="form-control" id="rfcrepre" maxlength="50" value="{{$generador->rfcrepre}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="identificacionreprepdf">Identificación (PDF)</label>
                                                <input type="file" name="identificacionreprepdf" class="form-control" id="identificacionreprepdf" accept="application/pdf">
                                                @if($generador->identificacionreprepdf)
                                                    <a href="{{ asset('documentos/generadores/identificaciones/representante/'.$generador->identificacionreprepdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                        <i class="fa fa-file-pdf"></i> Ver actual
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rfcreprepdf">RFC Representante (PDF)</label>
                                                <input type="file" name="rfcreprepdf" class="form-control" id="rfcreprepdf" accept="application/pdf">
                                                @if($generador->rfcreprepdf)
                                                    <a href="{{ asset('documentos/generadores/rfc/representante/'.$generador->rfcreprepdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                        <i class="fa fa-file-pdf"></i> Ver actual
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-primary" id="empresa">
                                <div class="card-header">
                                    <h3 class="card-title">Empresa</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fechaconst">Fecha Constitución</label>
                                                <input type="date" name="fechaconst" class="form-control" id="fechaconst" value="{{$generador->fechaconst}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="numeroactacont">Número de acta constitutiva</label>
                                                <input type="text" name="numeroactacont" class="form-control" id="numeroactacont" maxlength="100" value="{{$generador->numeroactacont}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="numeroactacontpdf">Acta constitutiva (PDF)</label>
                                                <input type="file" name="numeroactacontpdf" class="form-control" id="numeroactacontpdf" accept="application/pdf">
                                                @if($generador->numeroactacontpdf)
                                                    <a href="{{ asset('documentos/generadores/actas/empresa/'.$generador->numeroactacontpdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                        <i class="fa fa-file-pdf"></i> Ver actual
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="podernotarial">Poder Notarial (PDF)</label>
                                                <input type="file" name="podernotarial" class="form-control" id="podernotarial" accept="application/pdf">
                                                <a href="{{ asset('documentos/generadores/actas/poder/'.$generador->id.'.pdf') }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                    <i class="fa fa-file-pdf"></i> Ver actual
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="domicilioempresapdf">Comprobante de domicilio fiscal (PDF)</label>
                                                <input type="file" name="domicilioempresapdf" class="form-control" id="domicilioempresapdf" accept="application/pdf">
                                                @if($generador->domicilioempresapdf)
                                                    <a href="{{ asset('documentos/generadores/comprobantedomicilio/empresa/'.$generador->domicilioempresapdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                        <i class="fa fa-file-pdf"></i> Ver actual
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="notario">Nombre del notario o corredor público</label>
                                                <input type="text" name="notario" class="form-control" id="notario" maxlength="250" value="{{$generador->notario}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="numeronotaria">Número de notaría o correduría</label>
                                                <input type="text" name="numeronotaria" class="form-control" id="numeronotaria" maxlength="150" value="{{$generador->numeronotaria}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="entidadnotaria">Entidad de la notaría</label>
                                                <input type="text" name="entidadnotaria" class="form-control" id="entidadnotaria" maxlength="100" value="{{$generador->entidadnotaria}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="bloqueFisica" style="{{ $generador->fisicaomoral == 'Física' ? '' : 'display:none;' }}">
                            <div class="card card-primary" id="fisica">
                                <div class="card-header">
                                    <h3 class="card-title">Personales</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombresfisica">Nombre(s)</label>
                                                <input type="text" name="nombresfisica" class="form-control" id="nombresfisica" maxlength="150" value="{{$generador->nombresfisica}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidosfisica">Apellidos</label>
                                                <input type="text" name="apellidosfisica" class="form-control" id="apellidosfisica" maxlength="150" value="{{$generador->apellidosfisica}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nacionalidadfisica">Nacionalidad</label>
                                                <input type="text" name="nacionalidadfisica" class="form-control" id="nacionalidadfisica" maxlength="100" value="{{$generador->nacionalidadfisica}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="identificacionfisica">Identificación</label>
                                                <input type="text" name="identificacionfisica" class="form-control" id="identificacionfisica" value="{{$generador->identificacionfisica}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="identificacionfisicapdf">Identificación (PDF)</label>
                                                <input type="file" name="identificacionfisicapdf" class="form-control" id="identificacionfisicapdf" accept="application/pdf">
                                                @if($generador->identificacionfisicapdf)
                                                    <a href="{{ asset('documentos/generadores/identificaciones/personafisica/'.$generador->identificacionfisicapdf) }}" target="_blank" class="btn btn-sm btn-default mt-1">
                                                        <i class="fa fa-file-pdf"></i> Ver actual
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-theme-success text-white">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </section>
  </div>

  @include('asociados.footer')
</div>

<script>
    function togglePersona() {
        var tipo = document.getElementById('fisicaomoral').value;
        var divMoral = document.getElementById('bloqueMoral');
        var divFisica = document.getElementById('bloqueFisica');

        if (tipo === 'Moral') {
            divMoral.style.display = 'block';
            divFisica.style.display = 'none';
        } else {
            divMoral.style.display = 'none';
            divFisica.style.display = 'block';
        }
    }
</script>
</body>
</html>