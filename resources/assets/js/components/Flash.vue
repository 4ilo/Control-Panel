<template>
    <div class="alert alert-flash" :class="alertClass" role="alert" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ["message", "type"],

        computed: {
            alertClass() {
                return "alert-" + this.alertType;
            },
            alertHeader() {
                switch (this.alertType) {
                    case "success":
                        return "Gelukt";
                    case "danger":
                        return "Mislukt";
                    default:
                        return "Gelukt!";
                }
            }
        },

        data() {
            return {
                body: "",
                alertType: "success",
                show: false,
            };
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            if (this.type) {
                this.alertType = this.type;
            }

            window.events.$on("flash-success", message => {
                this.flash(message, "success");
            });

            window.events.$on("flash-error", message => {
                this.flash(message, "danger");
            });
        },

        methods: {
            flash(message, type) {
                this.body = message;
                this.alertType = type;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
