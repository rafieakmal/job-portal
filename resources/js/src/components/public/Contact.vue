<template>
    <section class="py-5 mt-5">
        <div class="container-xl py-5">
            <div class="row">
                <div class="col text-center mx-auto">
                    <h2 class="display-6 fw-bold mb-4">Got any <span class="underline">questions</span>?</h2>
                    <p class="text-muted">Our team is always here to help. Send us a message and we'll get back to you shortly.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <div>
                        <form class="p-3 p-xl-4" method="post">
                            <div class="mb-3">
                                <input class="shadow form-control" type="text" id="name-1" name="name" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <input class="shadow form-control" type="email" id="email-1" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <textarea class="shadow form-control" id="message-1" name="message" rows="6" placeholder="Message"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary shadow d-block w-100" type="submit">Send </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Contact"
    }
</script>