<?php $this->load->view('general/cabecera');?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<img src="imagenes/bannerPrincipal.jpg" class="img-fluid" alt="ANALISIS">
<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active,
.accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}

.wrapper{
	text-align: center;
  }
 #map {
        width: 700px;
        height: 500px;
      }
</style>
<br>
<br>
<div class="container-fluid">
  <form id="fhoja">
    <div id="cabecera" class="row mb-5">
      <h3 class="h5 text-center col-md-12" style="color: #FF0000;">FORMULARIO DE ANÁLISIS EMERGENTE</h3>
      <h4 class="h5 text-center col-md-12">
        Campos Obligatorios (*)
        <br>
        Favor verifique sus datos antes de llenar el Formulario
      </h4>
    </div>

    <label class="accordion" id="btc"><label for="titulo" class="h5" style="color: #000000;">1.- Datos
        Generales</label></label>
    <hr>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputTipoDocumento" class="h5">Tipo de Documento(*)</label>
        <?php echo $combo_documento; ?>
      </div>

      <div class="form-group col-md-6">
        <label for="inputNumeroDocumento" class="h5">Número de Documento(*)</label>
        <input type="text" onKeyPress="return soloLetras(event)" maxlength="19" class="form-control" name="FORM_CEDULA"
          id="FORM_CEDULA"
          value="<?php echo !empty($sol->FORM_CEDULA) ? prepCampoMostrar($sol->FORM_CEDULA) : null ; ?>" 
		  placeholder="favor no coloque espacios en blanco al inicio o final, tampoco coloque guiones -, Ejemplo:1234567890"/>
      </div>
    </div>

    <div class="form-row">

      <div class="form-group col-md-6">
        <label for="inputNombres" class="h5">Apellidos(*)</label>
        <input type="text" maxlength="99" class="form-control" name="FORM_APELLIDOS" id="FORM_APELLIDOS"
          value="<?php echo !empty($sol->FORM_APELLIDOS) ? prepCampoMostrar($sol->FORM_APELLIDOS) : null ; ?>"
		  placeholder="PRIMERO SEGUNDO APELLIDO"/>
      </div>
      
	  <div class="form-group col-md-6">
        <label for="inputNombres" class="h5">Nombres(*)</label>
        <input type="text" maxlength="50" class="form-control" name="FORM_NOMBRES" id="FORM_NOMBRES"
          value="<?php echo !empty($sol->FORM_NOMBRES) ? prepCampoMostrar($sol->FORM_NOMBRES) : null ; ?>"
		  placeholder="PRIMERO SEGUNDO NOMBRE"/>
      </div>
    </div>
    
	<div class="form-row">

      <div class="form-group col-md-12">
        <div class="alert alert-primary" role="alert">
          <strong style="font-size: 16px; line-height : 25px">Info!</strong>
              <p style="text-align: justify; font-size: 16px">En caso de no contar con un correo personal,
                puede crear uno de manera gratuita en <a href="https://www.google.com/intl/es/gmail/about/"
                  target="_blank">Gmail</a>,
                <a href="https://www.microsoft.com/es-es/microsoft-365/outlook/email-and-calendar-software-microsoft-outlook"
                  target="_blank">Outlook</a> o el servicio de su preferencia.</p>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label for="inputCorreoInstitucional" class="h5">Fecha de nacimiento(*)</label>
        <input type="date" maxlength="10" class="form-control" name="FORM_FECHA_NACIMIENTO" id="FORM_FECHA_NACIMIENTO"
          value="<?php echo !empty($sol->FORM_FECHA_NACIMIENTO) ? prepCampoMostrar($sol->FORM_FECHA_NACIMIENTO) : null ; ?>" />
      </div>

      <div class="form-group col-md-6">
        <label for="inputCorreoPersonal" class="h5">Correo electrónico personal(*)</label>
        <input type="text" maxlength="199" onKeyPress="return soloCorreo(event)" class="form-control"
          name="FORM_CORREO_PERSONAL" id="FORM_CORREO_PERSONAL"
          value="<?php echo !empty($sol->FORM_CORREO_PERSONAL) ? prepCampoMostrar($sol->FORM_CORREO_PERSONAL) : null ; ?>"
          placeholder="correo@dominio.com" />
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Número de Celular(*)</label>
        <input type="text" onKeyPress="return soloNumeros(event)" minlength="9" maxlength="10" class="form-control"
          name="FORM_CELULAR" id="FORM_CELULAR"
          value="<?php echo !empty($sol->FORM_CELULAR) ? prepCampoMostrar($sol->FORM_CELULAR) : null ; ?>"
          placeholder="0981234567" />
      </div>

      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Número Convencional</label>
        <input type="text" onKeyPress="return soloNumeros(event)" minlength="9" maxlength="10" class="form-control"
          name="FORM_CONVENCIONAL" id="FORM_CONVENCIONAL"
          value="<?php echo !empty($sol->FORM_CONVENCIONAL) ? prepCampoMostrar($sol->FORM_CONVENCIONAL) : null ; ?>"
          placeholder="022123456" />
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputNivel" class="h5">Genero(*)</label>
        <?php echo $combo_genero; ?>
      </div>	  
	  <div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">Estado civil(*)</label>
        <?php echo $combo_civil; ?>
      </div>
	  <div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">Tipo de sangre(*)</label>
        <?php echo $combo_tipoSangre; ?>
      </div>      
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Etnia(*)</label>
        <?php echo $combo_etnia; ?>
      </div>

      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Pueblo y Nacionalidad(*)</label>
        <?php echo $combo_pueblos; ?>
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">País de nacionalidad(*)</label>
        <?php echo $combo_paisnacionalidad; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PAIS_NACIMIENTO" id="FORM_PAIS_NACIMIENTO"
          value="<?php echo !empty($sol->FORM_PAIS_NACIMIENTO) ? prepCampoMostrar($sol->FORM_PAIS_NACIMIENTO) : null ; ?>"
          placeholder="País de Nacionalidad" />
      </div>
      <div class="form-group col-md-4">
        <label for="inputNivel" class="h5">Provincia de nacimiento(*)</label>
        <?php echo $combo_provincianacionalidad; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PROVINCIA_NACIMIENTO" id="FORM_PROVINCIA_NACIMIENTO"
          value="<?php echo !empty($sol->FORM_PROVINCIA_NACIMIENTO) ? prepCampoMostrar($sol->FORM_PROVINCIA_NACIMIENTO) : null ; ?>"
          placeholder="Provincia de Nacimiento" />
      </div>
      <div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">Cantón de nacimiento(*)</label>
        <?php echo $combo_ciudadnacionalidad; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_CANTON_NACIMIENTO" id="FORM_CANTON_NACIMIENTO"
          value="<?php echo !empty($sol->FORM_CANTON_NACIMIENTO) ? prepCampoMostrar($sol->FORM_CANTON_NACIMIENTO) : null ; ?>"
          placeholder="Cantón de Nacimiento" />
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputNivel" class="h5">País de residencia(*)</label>
        <?php echo $combo_paisreside; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PAIS_RESIDE" id="FORM_PAIS_RESIDE"
          value="<?php echo !empty($sol->FORM_PAIS_RESIDE) ? prepCampoMostrar($sol->FORM_PAIS_RESIDE) : null ; ?>"
          placeholder="País de Residencia" />
      </div>
      <div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">Provincia de residencia(*)</label>
        <?php echo $combo_provinciareside; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PROVINCIA_RESIDE" id="FORM_PROVINCIA_RESIDE"
          value="<?php echo !empty($sol->FORM_PROVINCIA_RESIDE) ? prepCampoMostrar($sol->FORM_PROVINCIA_RESIDE) : null ; ?>"
          placeholder="Provincia de Residencia" />
      </div>
      <div class="form-group col-md-4">
        <label for="inputNivel" class="h5">Cantón de residencia(*)</label>
        <?php echo $combo_ciudadreside; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_CANTON_RESIDE" id="FORM_CANTON_RESIDE"
          value="<?php echo !empty($sol->FORM_CANTON_RESIDE) ? prepCampoMostrar($sol->FORM_CANTON_RESIDE) : null ; ?>"
          placeholder="Cantón de Residencia" />
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-3">
        <label for="inputNivel" class="h5">País de sufragio(*)</label>
        <?php echo $combo_paissufragio; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PAIS_SUFRAGIO" id="FORM_PAIS_SUFRAGIO"
          value="<?php echo !empty($sol->FORM_PAIS_SUFRAGIO) ? prepCampoMostrar($sol->FORM_PAIS_SUFRAGIO) : null ; ?>"
          placeholder="País de Sufragio" />
      </div>
      <div class="form-group col-md-3">
        <label for="inputModalidad" class="h5">Provincia de sufragio(*)</label>
        <?php echo $combo_provinciasufragio; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_PROVINCIA_SUFRAGIO" id="FORM_PROVINCIA_SUFRAGIO"
          value="<?php echo !empty($sol->FORM_PROVINCIA_SUFRAGIO) ? prepCampoMostrar($sol->FORM_PROVINCIA_SUFRAGIO) : null ; ?>"
          placeholder="Provincia de Sufragio" />
      </div>
      <div class="form-group col-md-3">
        <label for="inputNivel" class="h5">Cantón de sufragio(*)</label>
        <?php echo $combo_ciudadsufragio; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_CANTON_SUFRAGIO" id="FORM_CANTON_SUFRAGIO"
          value="<?php echo !empty($sol->FORM_CANTON_SUFRAGIO) ? prepCampoMostrar($sol->FORM_CANTON_SUFRAGIO) : null ; ?>"
          placeholder="Cantón de Sufragio" />
      </div>
      <div class="form-group col-md-3">
        <label for="inputNivel" class="h5">Parroquia de sufragio(*)</label>
        <?php echo $combo_sectorsufragio; ?>
        <input type="text" maxlength="99" class="form-control" name="FORM_SECTOR_SUFRAGIO" id="FORM_SECTOR_SUFRAGIO"
          value="<?php echo !empty($sol->FORM_SECTOR_SUFRAGIO) ? prepCampoMostrar($sol->FORM_SECTOR_SUFRAGIO) : null ; ?>"
          placeholder="Parroquia de Sufragio" />
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-12">
        <label for="inputNumeroDocumento" class="h5">Dirección Domiciliaria(*)</label>
        <input type="text" maxlength="499" class="form-control" name="FORM_DIRECCION"
          id="FORM_DIRECCION"
          value="<?php echo !empty($sol->FORM_DIRECCION) ? prepCampoMostrar($sol->FORM_DIRECCION) : null ; ?>" 
		  placeholder="Calle principal, número de casa, calle secundaria (referencia)"/>
      </div>
    </div>
    
	<label class="accordion"><label for="titulo" class="h5" style="color: #000000;">2.- Contacto de Emergencia</label></label>
	<hr>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Nombre de una persona de contacto(*)</label>
        <input type="text" maxlength="299" class="form-control" name="FORM_NOMBRES_CONTACTO" id="FORM_NOMBRES_CONTACTO"
          value="<?php echo !empty($sol->FORM_NOMBRES_CONTACTO) ? prepCampoMostrar($sol->FORM_NOMBRES_CONTACTO) : null ; ?>"
          placeholder="Apellidos y Nombres" />
      </div>
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Relación con el estudiante(*)</label>
        <?php echo $combo_relacioncontacto; ?>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Número de celular del contacto(*)</label>
        <input type="text" onKeyPress="return soloNumeros(event)" minlength="9" maxlength="10" class="form-control"
          name="FORM_CELULAR_CONTACTO" id="FORM_CELULAR_CONTACTO"
          value="<?php echo !empty($sol->FORM_CELULAR_CONTACTO) ? prepCampoMostrar($sol->FORM_CELULAR_CONTACTO) : null ; ?>"
          placeholder="0981234567" />
      </div>

      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Número convencional del contacto</label>
        <input type="text" onKeyPress="return soloNumeros(event)" maxlength="10" class="form-control"
          name="FORM_COVENCIONAL_CONTACTO" id="FORM_COVENCIONAL_CONTACTO"
          value="<?php echo !empty($sol->FORM_COVENCIONAL_CONTACTO) ? prepCampoMostrar($sol->FORM_COVENCIONAL_CONTACTO) : null ; ?>"
          placeholder="022123456" />
      </div>

      <div class="form-group col-md-12">
        <label for="inputNumeroCelular" class="h5">Correo electrónico de contacto</label>
        <input type="text" maxlength="199" class="form-control" name="FORM_CORREO_CONTACTO" id="FORM_CORREO_CONTACTO"
          value="<?php echo !empty($sol->FORM_CORREO_CONTACTO) ? prepCampoMostrar($sol->FORM_CORREO_CONTACTO) : null ; ?>"
          placeholder="correo@dominio.com" />
      </div>
    </div>
	
    <label class="accordion" id="btc"><label for="titulo" class="h5" style="color: #000000;">3.- Educación</label></label>
	<hr>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Nivel de Formación(*)</label>
        <?php echo $combo_formacion; ?>
      </div>
	  
	  <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Cuenta con la certificación en idioma inglés(*)</label>
        <?php echo $combo_idioma; ?>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de Computadores, Laptops(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_COMPUS" id="FORM_NUM_COMPUS"
          value="<?php echo !empty($sol->FORM_NUM_COMPUS) ? prepCampoMostrar($sol->FORM_NUM_COMPUS) : 0; ?>" />
      </div>
	  <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de Celulares, Iphones(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_CELULARES" id="FORM_NUM_CELULARES"
          value="<?php echo !empty($sol->FORM_NUM_CELULARES) ? prepCampoMostrar($sol->FORM_NUM_CELULARES) : 0; ?>" />
      </div>
      <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de Tablets, Ipads(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_TABLETS" id="FORM_NUM_TABLETS"
          value="<?php echo !empty($sol->FORM_NUM_TABLETS) ? prepCampoMostrar($sol->FORM_NUM_TABLETS) : 0; ?>" />
      </div>
    </div>
    
	<div class="form-row">
		<div class="form-group col-md-4">
        <label for="inputModalidad" class="h5">Posee servicio de Internet(*)</label>
        <?php echo $combo_internet; ?>
      </div>
	  <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de Estudiante entre Escuela y Colegio dentro del hogar(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_ESTUD_EAC" id="FORM_NUM_ESTUD_EAC"
          value="<?php echo !empty($sol->FORM_NUM_ESTUD_EAC) ? prepCampoMostrar($sol->FORM_NUM_ESTUD_EAC) : 0; ?>" />
      </div>
	  <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de Estudiante entre Universitarios dentro del hogar(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_ESTUD_UNIV" id="FORM_NUM_ESTUD_UNIV"
          value="<?php echo !empty($sol->FORM_NUM_ESTUD_UNIV) ? prepCampoMostrar($sol->FORM_NUM_ESTUD_UNIV) : 0; ?>" />
      </div>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputDireccion" class="h5">Números de Instituciones Entre Escuelas y Colegios cerca de su sector(*)</label>
			<input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
			  name="FORM_NUM_ESCCOL" id="FORM_NUM_ESCCOL"
			  value="<?php echo !empty($sol->FORM_NUM_ESCCOL) ? prepCampoMostrar($sol->FORM_NUM_ESCCOL) : 0; ?>" />
		 </div>
		<div class="form-group col-md-6">
			<label for="inputDireccion" class="h5">Números de Instituciones Entre Institutos y Universidades cerca de su sector(*)</label>
			<input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
			  name="FORM_NUM_UNIVERSIDADES" id="FORM_NUM_UNIVERSIDADES"
			  value="<?php echo !empty($sol->FORM_NUM_UNIVERSIDADES) ? prepCampoMostrar($sol->FORM_NUM_UNIVERSIDADES) : 0; ?>" />
		  </div> 
	</div>
	
	<label class="accordion"><label for="titulo" class="h5" style="color: #000000;">4.- Salud</label></label>
	<hr>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tiene a cargo una persona con discapacidad(*)</label>
        <?php echo $combo_cargodiscapacidad; ?>
      </div>
	  
	  <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Usted posee alguna discapacidad(*)</label>
        <?php echo $combo_discapacidad; ?>
      </div>

      <div id="PORDISCAPACIDAD" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Porcentaje de discapacidad(*)</label>
        <input type="number" step="1" min="0" max="999" onKeyPress="return soloNumeros(event)" class="form-control"
          name="FORM_PORCENTAJE_DISCAP" id="FORM_PORCENTAJE_DISCAP"
          value="<?php echo !empty($sol->FORM_PORCENTAJE_DISCAP) ? prepCampoMostrar($sol->FORM_PORCENTAJE_DISCAP) : null ; ?>"
          placeholder="0-100" />
      </div>
    </div>

    <div id="CARNETIPO" class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Número de carnét de Conadis o MSP(*)</label>
        <input type="text" maxlength="20" onKeyPress="return soloLetras(event)" class="form-control"
          name="FORM_CARNE_CANDIS" id="FORM_CARNE_CANDIS"
          value="<?php echo !empty($sol->FORM_CARNE_CANDIS) ? prepCampoMostrar($sol->FORM_CARNE_CANDIS) : null ; ?>"
          placeholder="0000000000" />
      </div>
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tipo discapacidad(*)</label>
        <?php echo $combo_tipoDiscapacidad; ?>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tiene alguna enfermedad que requiera cuidado diario(*)</label>
        <?php echo $combo_enfermedad; ?>
      </div>

      <div id="OBSEMFERMEDAD" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Nombre del cuidado que requiere(*)</label>
        <input type="text" maxlength="499" class="form-control" name="FORM_EMFERMEDADDES" id="FORM_EMFERMEDADDES"
          placeholder="(en el caso de haber seleccionado si anteriormente)"
          value="<?php echo !empty($sol->FORM_EMFERMEDADDES) ? prepCampoMostrar($sol->FORM_EMFERMEDADDES) : null ; ?>"
          placeholder="Descripción" />
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tiene alguna alergia(*)</label>
        <?php echo $combo_alergia; ?>
      </div>

      <div id="OBSALERGIA" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Indicar el nombre de la alergia(*)</label>
        <input type="text" maxlength="499" class="form-control" name="FORM_ALERGIADES" id="FORM_ALERGIADES"
          placeholder="(en el caso de haber seleccionado si anteriormente)"
          value="<?php echo !empty($sol->FORM_ALERGIADES) ? prepCampoMostrar($sol->FORM_ALERGIADES) : null ; ?>"
          placeholder="Descripción alergias" />
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Usa algún tipo de medicamento/os(*)</label>
        <?php echo $combo_medicacion; ?>
      </div>

      <div id="OBSMEDICACION" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Indicar el nombre del medicamento/os(*)</label>
        <input type="text" maxlength="499" class="form-control" name="FORM_MEDICACIONDES" id="FORM_MEDICACIONDES"
          placeholder="(en el caso de haber seleccionado si anteriormente)"
          value="<?php echo !empty($sol->FORM_MEDICACIONDES) ? prepCampoMostrar($sol->FORM_MEDICACIONDES) : null ; ?>"
          placeholder="Descripción de medicamentos" />
      </div>
    </div>
    
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="inputModalidad" class="h5">Tiene cerca un centro del Minesterio de Salud Pública, dentro de su sector(*)</label>
			<?php echo $combo_cercamsp; ?>
		  </div>
		<div class="form-group col-md-4">
			<label for="inputDireccion" class="h5">Números de Farmacias cerca de su sector(*)</label>
			<input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
			  name="FORM_NUM_FARMACIAS" id="FORM_NUM_FARMACIAS"
			  value="<?php echo !empty($sol->FORM_NUM_FARMACIAS) ? prepCampoMostrar($sol->FORM_NUM_FARMACIAS) : 0; ?>" />
		  </div> 
		<div class="form-group col-md-4">
			<label for="inputDireccion" class="h5">Números de Clinicas, Centros Medicos u Hospitales cerca de su sector(*)</label>
			<input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
			  name="FORM_NUM_HOSPITALES" id="FORM_NUM_HOSPITALES"
			  value="<?php echo !empty($sol->FORM_NUM_HOSPITALES) ? prepCampoMostrar($sol->FORM_NUM_HOSPITALES) : 0; ?>" />
		  </div>   
	</div>
	
	<label class="accordion"><label for="titulo" class="h5" style="color: #000000;">5.- Economía</label></label>
	<hr>
	
	<div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputNumeroCelular" class="h5">Número de miembros del hogar (*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="1" max="999" class="form-control"
          name="FORM_NUM_FAMILIA" id="FORM_NUM_FAMILIA"
          value="<?php echo !empty($sol->FORM_NUM_FAMILIA) ? prepCampoMostrar($sol->FORM_NUM_FAMILIA) : 0; ?>" />
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="inputDireccion" class="h5">Números de hijos(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_HIJOS" id="FORM_NUM_HIJOS"
          value="<?php echo !empty($sol->FORM_NUM_HIJOS) ? prepCampoMostrar($sol->FORM_NUM_HIJOS) : 0; ?>" />
      </div>
	  
	  <div class="form-group col-md-4">
        <label for="inputNumeroCelular" class="h5">Ingresos del hogar(*)</label>
        <input type="number" class="form-control" onKeyPress="return soloNumeros(event)" step="0.1" min="1" max="999999"
          placeholder="Ingresa un monto total de lo que percibe la familia" name="FORM_CANT_INGRESOS"
          id="FORM_CANT_INGRESOS"
          value="<?php echo !empty($sol->FORM_CANT_INGRESOS) ? prepCampoMostrar($sol->FORM_CANT_INGRESOS) : 0; ?>" />
      </div>      
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Algún miembro de su familia, en primer grado de consanguinidad,
          recibe bono del estado?(*)</label>
        <?php echo $combo_bono; ?>
      </div>
	  <div class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Qué tipo de vivienda posee(*)</label>
        <?php echo $combo_vivienda; ?>
      </div>
    </div>
	
	<div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Al momento usted se encuentra laborando(*)</label>
        <?php echo $combo_trabajo; ?>
      </div>

      <div id="HORARIOLABORA" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Ingrese su horario de trabajo (*)</label>
        <input type="text" maxlength="399" class="form-control" name="FORM_HORARIO_LABORA" id="FORM_HORARIO_LABORA"
          placeholder="(en el caso de haber seleccionado si anteriormente)"
          value="<?php echo !empty($sol->FORM_HORARIO_LABORA) ? prepCampoMostrar($sol->FORM_HORARIO_LABORA) : null ; ?>" />
      </div>
    </div>
	<div id="USOINGRESOS" class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">El ingresante para qué emplea sus ingresos(*)</label>
        <?php echo $combo_usoIngresos; ?>
      </div>

      <div id="INGRESOSDES" class="form-group col-md-6">
        <label for="inputNumeroCelular" class="h5">Especifique uso de ingresos(*)</label>
        <input type="text" maxlength="399" class="form-control" name="FORM_INGRESOSDES" id="FORM_INGRESOSDES"
          value="<?php echo !empty($sol->FORM_INGRESOSDES) ? prepCampoMostrar($sol->FORM_INGRESOSDES) : null ; ?>"
          placeholder="Describa" />
      </div>
    </div>
		
    <label class="accordion"><label for="titulo" class="h5" style="color: #000000;">6.- Seguridad</label></label>
	<hr>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tiene cerca un reten policial en su sector(*)</label>
        <?php echo $combo_cercareten; ?>
      </div>

      <div class="form-group col-md-6">
        <label for="inputDireccion" class="h5">Números de patrullajes que puede a la semana(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_PATRULLAJES" id="FORM_NUM_PATRULLAJES"
          value="<?php echo !empty($sol->FORM_NUM_PATRULLAJES) ? prepCampoMostrar($sol->FORM_NUM_PATRULLAJES) : 0; ?>" />
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputModalidad" class="h5">Tiene su barrio alarma comunitaria(*)</label>
        <?php echo $combo_alarma; ?>
      </div>

      <div class="form-group col-md-6">
        <label for="inputDireccion" class="h5">Números de robos que evidencia a la semana(*)</label>
        <input type="number" onKeyPress="return soloNumeros(event)" step="1" min="0" max="999" class="form-control"
          name="FORM_NUM_ROBOS" id="FORM_NUM_ROBOS"
          value="<?php echo !empty($sol->FORM_NUM_ROBOS) ? prepCampoMostrar($sol->FORM_NUM_ROBOS) : 0; ?>" />
      </div>
    </div>
    
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputDireccion" class="h5">En que frecuencia hay mas robos en su sector(*)</label>
			<?php echo $combo_frecuencia; ?>
		</div>
		<div class="form-group col-md-6">
			<label for="inputDireccion" class="h5">Lugar mas frecuente de robos en su sector(*)</label>
			<?php echo $combo_lugarrobos; ?>
			<input type="text" maxlength="99" class="form-control" name="FORM_LUGAR_ROBODES" id="FORM_LUGAR_ROBODES"
			  value="<?php echo !empty($sol->FORM_LUGAR_ROBODES) ? prepCampoMostrar($sol->FORM_LUGAR_ROBODES) : null ; ?>"
			  placeholder="Describa el lugar" />
		</div>
	</div>
	
	<label class="accordion"><label for="titulo" class="h5" style="color: #000000;">7.- Redes Sociales</label></label>
	<hr>

    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="inputModalidad" class="h5">Usa redes sociales(*)</label>
        <?php echo $combo_usaredes; ?>
      </div>

    </div>

    <div class="form-row" id="TIPOREDES">
      <div class="form-group col-md-12">
        <label for="inputNumeroCelular" class="h5">Cuál es la red social que utiliza con mayor frecuencia</label>
      </div>	  
      <div class="form-group col-md-12">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="myCheck" name="FORM_TIPOREDSOCIAL[]" value="1">
          <label class="custom-control-label" for="myCheck">Facebook</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="myCheck1" name="FORM_TIPOREDSOCIAL[]" value="2">
          <label class="custom-control-label" for="myCheck1">Twitter</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="myCheck2" name="FORM_TIPOREDSOCIAL[]" value="3">
          <label class="custom-control-label" for="myCheck2">Instragram</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="myCheck3" name="FORM_TIPOREDSOCIAL[]" value="4">
          <label class="custom-control-label" for="myCheck3">Linkedin</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="myCheck4" name="FORM_TIPOREDSOCIAL[]" value="5">
          <label class="custom-control-label" for="myCheck4">Google+</label>
        </div>
      </div>
    </div>
	
	<label class="accordion"><label for="titulo" class="h5" style="color: #000000;">8.- Ubicación</label></label>
	<hr>
	
	<div class="form-row">
		<label for="inputUbicacion" class="h5">Favor mover el <img src="./imagenes/pinUbicacion.png" width="15px"> punto de ubicación al lugar de su vivienda</label>
		<div id="map" class="form-group col-md-12"></div>		
	</div>	
	
	<br>
	
    <div class="text-center">
      <?php if($accion=='n'|$accion=='e') : ?>
      <div class="form-group col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-btn col-xs-12 col-sm-12">
              <button style="width: 50%; height: 65px" class="btn btn-success "
                title="Verifique la información antes de guardar." id="co_grabar" name="co_grabar" type="submit">
				<i class="far fa-save">
                </i> Enviar formulario</button>
            </div>
          </div>
        </div>
      </div>
      <hr>

      <div class="card bg-light align-items-center">
        <div class="card bg-light">
          <div class="text-center">
            <div class="card-header text-white" style="background-color: #91CBDE"><label for="titulo" class="h5"
                style="color: #000000;">Soporte</label></div>
          </div>
          <div class="card-body">
            <p style="text-align: center; font-size:17px" class="card-text">En el caso de que tenga algún inconveniente
              en
              el llenado del formulario
              o no llegue la confirmación a su correo personal o institucional,
              favor comuníquese al correo: <u><b>soporte@institucion.com</b></u>.</p>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>


	<input type="hidden" name="FORM_SECUENCIAL" id="FORM_SECUENCIAL"
		value="<?php echo !empty($sol->FORM_SECUENCIAL) ? prepCampoMostrar($sol->FORM_SECUENCIAL) : 0 ; ?>" />
	<input type="hidden"  name="FORM_LATITUD" id="FORM_LATITUD" value="<?php echo !empty($sol->FORM_LATITUD) ? prepCampoMostrar($sol->FORM_LATITUD) : 0 ; ?>"  />
	<input type="hidden"  name="FORM_LONGITUD" id="FORM_LONGITUD" value="<?php echo !empty($sol->FORM_LONGITUD) ? prepCampoMostrar($sol->FORM_LONGITUD) : 0 ; ?>"  />  
  </form>
</div>

<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e) {
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}

//PERMITE SOLO LETRAS
function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = "abcdefghijklmnopqrstuvwxyz0123456789";
  const especiales = ['8', '37', '39', '46'];

  tecla_especial = false
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}

//para correo
function soloCorreo(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = "abcdefghijklmnñopqrstuvwxyz0123456789@.-_"; //permitidas
  const especiales = ['8', '37', '39', '46']; //permitidas

  tecla_especial = false
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}
  
//GOOGLE MAPS
var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
		var UTPL = {lat: -0.1946811, lng: -78.482583};        
		var map = new google.maps.Map(document.getElementById('map'), {
          center: UTPL,
          zoom: 15		  
        });
		marker = new google.maps.Marker({
			map: map,
			draggable: true,
			animation: google.maps.Animation.DROP,
			position: UTPL
		});
		marker.addListener('dragend', toggleBounce);
		
        }
		function toggleBounce() {
		  if (marker.getAnimation() !== null) {
			alert("ERROR...");
		  } else {
			var latitud = marker.position.lat();
			var longitud = marker.position.lng();
			$('#FORM_LATITUD').val(latitud);
			$('#FORM_LONGITUD').val(longitud);
		  }
		}
		
      function doNothing() {}  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCheqX49uypSb3dmd1oEt5LXDpBjtymggs&callback=initMap"
async defer></script>
