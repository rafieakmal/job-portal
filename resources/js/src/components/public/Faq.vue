<template>
    <section class="py-4 py-xl-5 mb-5">
        <div class="container-xl">
            <div class="row mb-2">
                <div class="col text-center mx-auto">
                    <h2 class="display-6 fw-bold mb-5"><span class="pb-3 underline">FAQ<br></span></h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col mx-auto">
                    <div class="accordion text-muted" role="tablist" id="accordion-1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1">Aenean arcu euismod aliquam, volutpat consequat?</button></h2>
                            <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p>Maecenas diam volutpat, erat quis enim cras lobortis vivamus donec tempor. Congue ultrices donec turpis vivamus. Laoreet aenean metus, mi nunc massa feugiat duis. Pharetra erat consequat purus curae quisque, etiam accumsan class.</p>
                                    <p class="mb-0">Commodo rutrum quisque curabitur habitasse, suspendisse etiam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">Lorem quam erat placerat mollis, rhoncus senectus?</button></h2>
                            <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">Iaculis accumsan id, facilisis proin ipsum velit neque?</button></h2>
                            <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Faq"
    }
</script>