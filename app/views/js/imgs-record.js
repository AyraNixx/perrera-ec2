$(document).ready(function () {  
  const id = new URLSearchParams(window.location.search).get("id");
  // Eventos
  $(document).on("click", '[data-toggle="lightbox"]', open_ekko_modal);
  $(document).on("click", 'button[data-modal-footer="delete"]', delete_img);
  $(document).on("click", 'button[data-modal-footer="download"]', download_img);
  $(document).on("click", 'button[data-modal-footer="details"]', show_details);
  $(document).on("click", 'i[data-modal-header="add"]', trigger_file_input);
  $("#files-input-hidden").on("change", handle_file_input_change);
  $(document).on("submit", ".imgs-container form", handle_submit);
  $("#files-tab-link").on("click", handle_tab_click);

  // Funciones
  function open_ekko_modal(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      onShown: updateLightboxModal,
      onNavigate: updateLightboxModal,
    });
  }

  function updateLightboxModal() {
    let img_id = getImgData(this, "data-img-id");
    let url = getImgData(this, "src");
    let name = getImgData(this, "alt");
    upd_modal_footer(img_id, url, name);
  }

  function getImgData(lightbox, attr) {
    return $(".imgs-container .row a")
      .eq(lightbox._galleryIndex)
      .find("img")
      .attr(attr);
  }

  function upd_modal_footer(id, url, name) {
    let modalFooter = $(".ekko-lightbox .modal-footer");
    modalFooter.empty();

    const buttons = [
      { icon: "fa-pen-to-square", action: "details", id },
      { icon: "fa-trash-can", action: "delete", id },
      { icon: "fa-upload", action: "download", id, url, name },
    ];

    buttons.forEach((btn) => {
      let button = $("<button>")
        .addClass("btn bg-transparent border-0 me-2")
        .attr("data-modal-footer", btn.action)
        .attr("data-id", btn.id)
        .html(`<i class="fa-solid ${btn.icon} text-primary"></i>`);
      if (btn.url) button.attr("data-url", btn.url);
      if (btn.name) button.attr("data-img-name", btn.name);
      modalFooter.append(button);
    });
  }

  function delete_img(e) {
    e.preventDefault();
    let id = $(this).attr("data-id");
    let confirmation = `<p>¿Estás seguro de que deseas eliminar esta imagen?</p>
    <div class="d-flex justify-content-center align-items-center">
    <button type="button" class="btn btn-danger confirm-delete" data-id="${id}">Eliminar</button>
    </div>`;
    create_modal(confirmation, "");
  }

  function delete_img_confirmed(e) {
    e.preventDefault();
    let id = $(this).attr("data-id");
    let data = { id, action: "record_imgs", action_img: "delete-img" };
    callControllerImg(data);
    $("#createModal").modal("hide");
  }

  function download_img(e) {
    e.preventDefault();
    let url = $(this).data("url");
    let name = $(this).data("img-name");
    const link = document.createElement("a");
    link.href = url;
    link.download = name;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  function show_details() {
    let controller = $("h1").attr("data-controller");
    let id = $(this).attr("data-id");
    let data = { id, action: "record_imgs", action_img: "get_one" };
    $.ajax({
      type: "POST",
      url: `../../app/controllers/${controller}`,
      data,
      dataType: "json",
      success: function (res) {
        if ((res && Array.isArray(res) && res.length > 0) || res.res === true) {
          if (data.action_img === "get_one") {
            let modal_text = `<row>
              <span class="h6 text-primary fw-bold">Nombre</span>
              <p class="text-info">${res[0].nombre}</p>
              <span class="h6 text-primary fw-bold">Tipo</span>
              <p class="text-info">${res[0].tipo}</p>
              <span class="h6 text-primary fw-bold">Tamaño</span>
              <p class="text-info">${res[0].tamanio}</p>
              <span class="h6 text-primary fw-bold">Nombre</span>
              <p class="text-info">${res[0].nombre}</p>
              <span class="h6 text-primary fw-bold">Fecha de subida</span>
              <p class="text-info">${res[0].fecha_subida}</p></row>`; // Convertir a cadena de texto HTML
            create_modal(modal_text, "Detalles");
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al obtener los datos - imgs:", error);
      },
    });
  }

  function create_modal(modalBodyText, title) {
    let close_modal =
      title != ""
        ? '<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>'
        : "";
    let modal = $(`
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true" style="background:#00000052;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-primary fw-bold" id="createModalLabel">${title}</h5>
              <button type="button" class="close bg-transparent border border-0" data-dismiss="modal" aria-label="Close" style="font-size:larger">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="p-2">${modalBodyText}</div>
            </div>
            <div class="modal-footer">
              ${close_modal}
            </div>
          </div>
        </div>
      </div>
    `);

    $("body").append(modal);
    modal.modal("show");

    modal.on("hidden.bs.modal", function () {
      $(this).remove();
    });

    if (title == "") {
      $(document).on("click", ".confirm-delete", delete_img_confirmed);
    }
  }

  function trigger_file_input(e) {
    e.preventDefault();
    $("#files-input-hidden").click();
  }

  function handle_file_input_change() {
    let files = $(this).prop("files");
    let data = new FormData();
    data.append("id", id);
    data.append("action", "record_imgs");
    data.append("action_img", "add");

    $.each(files, (i, file) => data.append("imgs[]", file));
    callControllerFilesSend(data);
    $(this).val("");
  }

  function handle_submit(e) {
    e.preventDefault();
    let data = new FormData(this);
    data.append("id", id);
    data.append("action", "record_imgs");
    data.append("action_img", "add");
    callControllerFilesSend(data);
  }

  function handle_tab_click(e) {
    if (!$(this).hasClass("active")) {
      let data = { id, action: "record_imgs", action_img: "get" };
      console.log('data: ', data);
      callControllerImg(data);
    }
  }

  function callControllerImg(data) {
    let controller = $("h1").attr("data-controller");
    $.ajax({
      type: "POST",
      url: `../../app/controllers/${controller}`,
      data,
      dataType: "json",
      success: function (res) {
        if ((res && Array.isArray(res) && res.length > 0) || res.res === true) {
          if (data.action_img === "get") {
            show_imgs(res);
          } else {
            callControllerImg({
              id: id,
              action_img: "get",
              action: "record_imgs",
            });

            if ($(".ekko-lightbox").hasClass("in")) {
              $(".ekko-lightbox").modal("hide");
            }
          }
          $(".fa-plus").show();
          $("#files-show #files-input-hidden").show();
        } else {
          show_uploader();
          $(".fa-plus").hide();
          $("#files-show #files-input-hidden").hide();
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al obtener los datos - imgs:", xhr.responseText);
      },
    });
  }

  function callControllerFilesSend(data) {
    let controller = $("h1").attr("data-controller");
    $.ajax({
      type: "POST",
      url: `../../app/controllers/${controller}`,
      data,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (res) {
        if (res.res === true) {
          if (data.get("action_img") === "add") {
            callControllerImg({
              id: data.get("id"),
              action_img: "get",
              action: "record_imgs",
            });
          }
          $(".fa-plus").show();
          $("#files-show #files-input-hidden").show();
        } else {
          show_uploader();
          $(".fa-plus").hide();
          $("#files-show #files-input-hidden").hide();
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al obtener los datos - imgs:", error);
      },
    });
  }

  function show_imgs(imgs) {
    let imgs_container = $(".imgs-container");
    imgs_container.empty();

    let row = $("<div>").addClass("row");
    imgs_container.append(row);

    imgs.forEach((im, i) => {
      let link = $("<a>")
        .attr({
          href: im.ruta,
          class: "col-12 col-sm-12 col-md-6 col-lg-3 py-5 px-3",
          "data-toggle": "lightbox",
          "data-gallery": "gallery",
        })
        .append(
          $("<img>").attr({
            src: im.ruta,
            alt: im.nombre,
            "data-img-id": im.id,
            class: "object-fit-cover w-100 h-100 border border-secondary",
            style: "max-height: 175px; object-position:50% 50%;",
          })
        );
      row.append(link);

      if ((i + 1) % 4 === 0) {
        row = $("<div>").addClass("row");
        imgs_container.append(row);
      }
    });
  }

  function show_uploader() {
    $(".imgs-container").html(`
      <div class="collapse show p-4 pt-1" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
        <div class="card-body text-center border border-1 border-secondary p-4 mt-3 rounded" style="max-width: fit-content;">
          <h4 class="text-primary">Subir nuevas imágenes</h4>
          <form class="uploader" enctype="multipart/form-data">
            <div class="mb-3">
              <i class="fa-solid fa-upload text-primary p-2 pb-4" style="font-size: xxx-large;"></i>
              <input class="form-control" type="file" name="imgs[]" id="imgs" accept="image/*" multiple>
            </div>
            <div id="uploader-box">
              <div>Selecciona uno o más archivos</div>
              <button type="submit" class="btn btn-primary mt-2 px-4" name="action" value="record_imgs" data-uploader="add">Subir</button>
            </div>
            <div id="uploader-res" class="hidden">
              <div id="uploader-res_msg"></div>
            </div>
          </form>
        </div>
      </div>
    `);
  }
});
