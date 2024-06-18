$(document).ready(function () {
  $('[name="show_task"]').on("change", get_tasks);
});

function get_tasks() {
  let id = $("#empleados_id").val();
  console.log(id);
  if (id != "" && id != null) {
      getTasksCallBack(id);
  }
}

function getTasksCallBack(id) {
  console.log(id);
  console.log($('[name="show_task"]').val());
  $.ajax({
      url: "../../app/controllers/AsignarTareasC.php",
      data: {
          action: "get_tasks_home",
          id: id,
          estado: $('[name="show_task"]').val(),
      },
      type: "POST",
      dataType: "json",
      success: function (data) {
          $("#home-tasks tbody").empty();  
          if (Array.isArray(data) && data.length > 0) { 
              console.log("data", data);
              let i = 0;  
              data.forEach(function (task) {
                  let st = i % 2 != 0 ? "bg-white" : "bg-secondary";
                  let row = `
                      <tr>
                          <td class="${st}"><a href="../controllers/AsignarTareasC.php?action=show_register&id=${task.id}">${task.asunto}</a></td>
                          <td class="${st}">${task.estado_asignacion}</td>
                          <td class="${st}">${task.fecha_asignacion}</td>
                          <td class="${st}">${task.fecha_finalizacion}</td>
                          <td class="${st}"><span class="${classBadge(task.prioridad)}">${task.prioridad}</span></td>
                      </tr>
                  `;
                  $("#home-tasks tbody").append(row);
                  i++;
              });
          } else {
              let emptyRow = `
                  <tr>
                      <td colspan="5" style='height:390px; font-size:larger;' class="text-center">No se encontraron registros</td>
                  </tr>
              `;
              $("#home-tasks tbody").append(emptyRow);
          }
      },
      error: function (xhr, status, error) {
          console.error("Error al obtener los datos:", error);
      },
  });
}

function classBadge(priority) {
  switch (priority.toLowerCase()) {
      case "baja":
          return "badge bg-success text-white";
      case "media":
          return "badge bg-warning text-dark";
      case "alta":
          return "badge bg-danger text-white";
      default:
          return "badge bg-secondary";
  }
}
