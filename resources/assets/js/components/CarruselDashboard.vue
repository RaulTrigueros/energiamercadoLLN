<template>
    <div class="container mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" target="_blank">Ir a Portal</a></li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h2>Gestor de imagenes del Carrusel</h2>
                <hr />
            </div>
            <div class="card col-12 p-0">
                <div class="card-header">
                    <div class="col-12 p-0 m-0 row">
                        <div class="col-7 row">
                            <div class="col-12">
                                <strong v-text="carrusel.titulo"></strong>
                            </div>
                            <div class="col-12">
                                <p v-text="carrusel.descripcion + '(max: 10 imágenes)'"></p>
                            </div>
                        </div>
                        <div
                            class="col-2 d-flex"
                        >
                            <button
                                class="btn btn-block btn-success"
                                @click="guardarOrden"
                                v-if="imagenes.length > 1"
                            >
                                Guardar Orden
                            </button>
                        </div>
                        <div class="col-3 ml-auto d-flex">
                            <button
                                class="btn btn-block btn-primary"
                                type="button"
                                data-toggle="modal"
                                data-target="#modalNuevaImg"
                                v-if="imagenes.length < 11"
                            >
                                Nueva IMG
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 row card-body">
                    <draggable
                        class="col-12 row mt-4 card-group"
                        group="imagenes"
                        @start="drag = true"
                        @end="drag = false"
                        v-model="imagenes"
                    >
                        <div
                            class="col-4"
                            v-for="(imagen, index) in imagenes"
                            :key="imagen.id"
                        >
                            <div class="card" style="cursor: grab">
                                <div class="card-body row">
                                    <strong  v-if="!imagen.estado"
                                        class="card-text col-8"
                                        v-text="imagen.titulo"
                                    ></strong>
                                    <span
                                        class="badge badge badge-info col-2 ml-auto"
                                        v-text="index + 1"
                                    ></span>
                                    <input
                                        v-if="imagen.estado"
                                        type="text"
                                        name=""
                                        
                                        v-model="imagen.titulo"
                                        class="form-control"
                                    />
                                </div>

                                <a
                                    data-fancybox="gallery"
                                    :href="
                                        '/imagen_carrusel/img/' + imagen.imagen
                                    "
                                    :data-caption="imagen.titulo"
                                    ><img
                                        :src="
                                            '/imagen_carrusel/img/' +
                                                imagen.imagen
                                        "
                                        alt="Card image"
                                        width="100%"
                                        height="250px"
                                /></a>
                                <div class="card-body">
                                    <p
                                        v-if="!imagen.estado"
                                        class="card-text"
                                        v-text="imagen.descripcion"
                                    >
                                        Descripcion
                                    </p>
                                    <input
                                        v-if="imagen.estado"
                                        type="text"
                                        name=""
                                        v-model="imagen.descripcion"
                                        class="form-control"
                                    />
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <button
                                                type=""
                                                class="btn btn-block btn-danger"
                                                @click="eliminar(imagen.id)"
                                            >
                                                Eliminar
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <button
                                                type=""
                                                class="btn btn-block btn-info"
                                                @click="editar(imagen)"
                                            >
                                            <strong v-if="!imagen.estado"> Editar</strong>
                                            <strong v-if="imagen.estado"> Guardar</strong>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </draggable>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div
            class="modal"
            id="modalNuevaImg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalNuevaImgLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNuevaImgLabel">
                            Nueva Imagen
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group ">
                                <label for="" class="form-control-label"
                                    >Titulo</label
                                >
                                <div class="">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputEmail3"
                                        placeholder="Título"
                                        v-model="tituloImg"
                                    />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="" class="form-control-label"
                                    >Descripción</label
                                >
                                <div class="">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputPassword3"
                                        placeholder="Descripción"
                                        v-model="descripcionImg"
                                    />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="" class="form-control-label"
                                    >Imagen</label
                                >
                                <div class="custom-file ">
                                    <input
                                        type="file"
                                        class="custom-file-input"
                                        id="customFile"
                                        @change="getImagen"
                                        accept="image/*"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="customFile"
                                        >Elija una Imagen</label
                                    >
                                </div>
                                <small class="text-muted">Por favor imagenes con un peso menor a 512Kb y preferentemente con dimensiones mayores a 900X400</small>
                            </div>
                            <div class="form-group mt-3">
                                <div class="">
                                    <button
                                        type="submit"
                                        class="btn btn-success btn-block"
                                        @click="validarForm()"
                                    >
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
import draggable from "vuedraggable";

export default {
    data() {
        return {
            imagenes: [],
            carrusel: "",
            tituloImg: " ",
            descripcionImg: " ",
            imagenImg: ""
        };
    },
    components: {
        draggable
    },
    methods: {
        getImagenes() {
            const me = this;
            axios
                .get("/carrusel/1")
                .then(res => {
                    me.carrusel = res.data;
                    axios
                        .get(`/carrusel/${me.carrusel.id}/imagenes`)
                        .then(res => {
                            me.imagenes = res.data;
                            console.log(me.imagenes);
                        })
                        .catch(error => error);
                })
                .catch(error => error);
        },
        guardarOrden(showMsg = true) {
            this.imagenes.forEach((imagen, index) => {
                axios
                    .post(
                        `/imagen_carrusel/orden/${imagen.id}/${index + 1}`,
                        []
                    )
                    .then(res => {
                        console.log("bien");
                    })
                    .catch(err => err);
            });
            if (showMsg) {
                this.emitSwal("success", "Se ordeno las imagens correctamente");
            }

            this.getImagenes();
        },
        emitSwal(tipo, mensaje, btn = false) {
            Swal.fire({
                position: "center",
                type: tipo,
                title: mensaje,
                showConfirmButton: btn,
                timer: 1500
            });
        },
        getImagen(event) {
            this.imagenImg = event.target.files[0];
            $(event.target).next().text(this.imagenImg.name).css('color', 'green');
            if(this.imagenImg.size > 600000){
                console.log('imagen muy pesada');
                this.imagenImg = '';
                $(event.target).next().text('Elija una imagen con peso menor a 512 kb').css("color", 'red');
            }
        },

        subirImagen() {
            console.log("subiendo img");

            const data = new FormData();
            data.append("titulo", this.tituloImg);
            data.append("descripcion", this.descripcionImg);
            data.append("imagen", this.imagenImg);
            data.append("orden", 1);

            axios
                .post("/imagen_carrusel/" + this.carrusel.id, data)
                .then(res => {
                    Swal.fire({
                        position: "center",
                        type: "success",
                        title: "Se ha subido la imagen correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.tituloImg = "";
                    this.descripcionImg = "";
                    this.imagenImg = "";
                    $('.custom-file-label').text('Elija una imagen').css('color', 'black');
                    this.cerrarModal();
                    this.getImagenes();
                })
                .catch(error => {
                    Swal.fire({
                        position: "center",
                        type: "error",
                        title: "No se ha podido subir la imagen",
                        showConfirmButton: true
                    });
                });
        },
        cerrarModal() {
            $("#modalNuevaImg").modal("hide");
            $(".modal-backdrop").remove();
        },
        move(event) {
            console.log(this.imagenes[0].id);
        },
        validarForm() {
            const errores = [];
            if (this.tituloImg.trim() === "") {
                errores.push("El titulo esta vacio");
            }
            if (this.descripcionImg.trim() === "") {
                errores.push("La descripcion esta vacia");
            }
            if (this.imagenImg === "") {
                errores.push("No se ha seleccionado imagenes");
            }

            if (errores.length === 0) {
                this.subirImagen();
            } else {
                let textError = "<ul>";
                for (let i = 0; i < errores.length; i++) {
                    textError += `<li>${errores[i]}</li>`;
                }
                textError += "</ul>";
                Swal.fire({
                        position: "center",
                        type: "error",
                        title: "Hay campos vacios.",
                        showConfirmButton: true,
                    });
            }
        },
        eliminar(id) {
            const me = this;
            axios
                .delete("/imagen_carrusel/" + id)
                .then(res => {
                    console.log(res);
                    me.getImagenes();
                    me.guardarOrden(false);
                    Swal.fire({
                        position: "center",
                        type: "success",
                        title: "La imagen fue eliminada",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(err => {
                    console.log(err);
                });
        },
        editar(imagen) {
            imagen.estado = !imagen.estado;
            if(imagen.estado === false){//guardar
                console.log('guardar imagen');
                // console.log(imagen);
                axios.put('/imagen_carrusel/'+imagen.id, {
                    'titulo': imagen.titulo,
                    'descripcion': imagen.descripcion
                }).then(res => {
                    console.log(res);
                    this.emitSwal('success', 'Se guardo exitosamente');
                })
                .catch(err => {
                    console.log(err)
                });
            }
            
        }
    },
    mounted() {
        this.getImagenes();
    }
};
</script>
