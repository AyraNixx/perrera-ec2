$(document).ready(function () {
  console.log("hi");
  $("#see_delete").on("click", open_delete_modal);
  $("#see_delete_modal btn-close").on("click", close_delete_modal);
  $("#search_val").on("keyup", function () {
    let value = $(this).val().toLowerCase();
    $("#see_delete_modal tbody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

function open_delete_modal() {
  generate_th();
  $("#see_delete_modal").modal("show");
  listCallBack();
}

function close_delete_modal() {
  $("#see_delete_modal").modal("hide");
}

function listCallBack() {
  console.log('controller_val', 'RTRTRTRTR');
  $.ajax({
    type: "POST",
    url: `../../app/controllers/${controller_val}`,
    data: {
      action: "show_delete_rows",
      controller: controller_val,
      register_id: id_page,
    },
    dataType: "json",
    success: function (res) {
      if (res && res.length > 0) {
        generate_table_rows_delete_modal(res);
      } else {
        let i = $("#see_delete_modal thead th").length;
        $("#see_delete_modal tbody").empty();
        $("#see_delete_modal tbody").html(
          `<tr><td colspan="${i}">No se encontraron registros.</td></tr>`
        );
      }
    },
    error: function (xhr, status) {
      console.error("Error fetching data:", xhr.responseText);
    },
  });
}

function generate_th(){
  let th;
  console.log(controller_val);
  if(controller_val == 'AtencionVeterinariaC.php'){
    th = ['Nombre veterinario', 'Nombre Animal', 'Especie', 'Jaula', ''];
  }else if(controller_val == 'VeterinarioC.php'){
    th = ['Nombre veterinario', 'Email', 'Clínica', ''];
  }else if(controller_val == 'AnimalC.php'){
    th = ['Nombre', 'Especie', 'Raza', 'Fech. Nacimiento', ''];
  }else if(controller_val == 'RolC.php'){
    th = ['Rol', 'Descripción', ''];
  }else if(controller_val == 'TareaC.php'){
    th = ['Asunto', 'Descripción', ''];
  }else if(controller_val == 'EspecieC.php'){
    th = ['Nombre', 'Descripción', ''];
  }else if(controller_val == 'JaulaC.php'){
    th = ['Ubicación', 'Especie', 'Tamaño', ''];
  }else{
    th = ['Nombre', 'NIF', 'Email', ''];
  }
  let header = '';
  th.forEach(function(t){
    header += '<th style="position: relative;">' + t + '</th>';
  });
  $('#see_delete_modal table thead tr').html(header);
}

function generate_table_rows_delete_modal(data) {
  console.log(data);
  let rows = "";
  data.forEach((v) => {
    switch (controller_val) {
      case "AtencionVeterinariaC.php":
        rows += `
                  <tr>
                      <td>${v.nombre_completo_veterinario}</td>
                      <td>${v.nombre_animal}</td>
                      <td>${v.nombre_especie}</td>
                      <td>${v.ubicacion}</td>
                      <td class='text-center'>
                      <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary">Recuperar</a>
                      </td>
                  </tr>
              `;
        break;
      case "VeterinarioC.php":
        rows += `
                  <tr>
                      <td>${v.nombre} ${v.apellidos}</td>
                      <td>${v.correo}</td>
                      <td>${v.nombre_clinica}</td>
                      <td>
                      <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                      </td>
                  </tr>
              `;
        break;
      case "AnimalC.php":
        rows += `
                    <tr>
                        <td>${v.nombre}</td>
                        <td>${v.nombre_especie}</td>
                        <td>${v.raza}</td>
                        <td>${v.fech_nac}</td>
                        <td>
                        <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                        </td>
                    </tr>
                `;
        break;
      case "RolC.php":
        rows += `
                    <tr>
                        <td>${v.rol}</td>
                        <td>${v.descripcion}</td>
                        <td>
                        <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                        </td>
                    </tr>
                `;
        break;
      case "TareaC.php":
        rows += `
                    <tr>
                        <td>${v.asunto}</td>
                        <td>${v.descripcion}</td>
                        <td>
                        <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                        </td>
                    </tr>
                `;
        break;
      case "EspecieC.php":
        rows += `
                      <tr>
                          <td>${v.nombre}</td>
                          <td>${v.descripcion}</td>
                          <td>
                          <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                          </td>
                      </tr>
                  `;
        break;
      case "JaulaC.php":
        rows += `
            <tr>
                <td>${v.ubicacion}</td>
                <td>${v.nombre_especie}</td>
                <td>${v.tamanio}</td>
                <td>
                    <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
                </td>
            </tr>`;
        break;
      default:
        rows += `
      <tr>
          <td>${v.nombre} ${v.apellidos}</td>
          <td>${v.NIF}</td>
          <td>${v.correo}</td>
          <td>
          <a href="../../app/controllers/${controller_val}?id=${v.id}&action=undelete" class="btn btn-primary"></a>
          </td>
      </tr>
  `;
        break;
    }
  });
  $("#see_delete_modal tbody").empty();
  $("#see_delete_modal tbody").html(rows);
}
