<template>
    <section class="py-4 py-md-5 my-5">
        <div class="container-xl py-md-5">
            <div class="row">
                <div class="col-md-5 text-center" id="img-heading">
                    <img class="img-fluid w-100" src="assets/img/illustrations/20824344_6343823.svg">
                </div>
                <div class="col text-start text-md-start">
                    <h2 class="display-6 text-center text-md-start fw-semibold mb-5">
                        Enter the code generated on your whatsapp below to get
                        <span class="underline pb-1">
                            verified!
                        </span>
                    </h2>
                    <div class="alert alert-danger alert-dismissible fade show mb-5" id="error-message" role="alert" v-if="error">
                        <strong>Error!</strong> {{ error }}
                    </div>
                    <div class="text-center">
                        <form class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" data-bs-theme="light">
                            <input v-for="(digit, index) in digits" type="number" @input="handleInput()" @paste.prevent="pasteCode()" v-model="digit.insert" ref="digits" :id="digit.id" :name="digit.id" :data-next="digit.next" :data-previous="digit.previous" @keyup="handleKeyUp(digit.id, $event)" />
                        </form>
                        <div v-if="!isLoading">
                            <button class="btn btn-primary fw-lighter shadow mt-5" type="button" style="width: 100%;" @click="verifyOtp()">Verify</button>

                        </div>

                        <div v-else>
                            <button class="btn btn-primary fw-lighter shadow mt-5" type="button" style="width: 100%;">
                                <b-spinner small label="Spinning"></b-spinner> Loading...
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">
                        <p v-if="!resendCodeStatus">Need a new code? <span class="underline pb-1" @click="resendCode()">click here</span></p>
                        <p v-else>Need a new code? <span class="underline pb-1">in {{ resendTimer }}s</span></p>
                    </div>
                    <!-- <p class="text-muted"><a href="/forgot-password">Forgot your password?</a></p> -->
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
@import url('https://fonts.googleapis.com/css?family=Raleway:200');

$BaseBG: #1f1f98;
.digit-group {
	input {
		width: 50px;
		height: 60px;
        border-radius: 5px;
        border: 1px solid #24285b;
		line-height: 50px;
		align-items: center;
        justify-content: center;
        text-align: center;
		font-size: 24px;
		font-family: 'Raleway', sans-serif;
		font-weight: 200;
		margin: 0 10px;
	}
}

@media (max-width: 500px) and (min-width: 384px) {
    .digit-group {
        input {
            width: 50px;
            height: 60px;
            line-height: 35px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
            text-align: center;
            font-size: 18px;
            margin: 0 5px;
        }
    }
}

@media (max-width: 384px) and (min-width: 280px) {
    .digit-group {
        input {
            width: 35px;
            height: 40px;
            line-height: 30px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
            text-align: center;
            font-size: 16px;
            margin: 0 2px;
        }
    }
}

@media (max-width: 280px) and (min-width: 240px) {
    .digit-group {
        input {
            width: 30px;
            height: 35px;
            line-height: 25px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
            text-align: center;
            font-size: 14px;
            margin: 0 2px;
        }
    }
}

@media (max-width: 240px) and (min-width: 202px) {
    .digit-group {
        input {
            width: 25px;
            height: 30px;
            line-height: 20px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
            text-align: center;
            font-size: 12px;
            margin: 0 2px;
        }
    }
}

@media (max-width: 202px) {
    .digit-group {
        input {
            width: 20px;
            height: 20px;
            line-height: 15px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
            text-align: center;
            font-size: 10px;
            margin: 0 1px;
        }
    }
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type='number'] {
    -moz-appearance: textfield;
}

.prompt {
	margin-bottom: 20px;
	font-size: 20px;
}

.shake {
  animation: shake 0.5s ease-in-out;
}

@keyframes shake {
  0%, 100% {
    transform: translateX(0);
  }
  25%, 75% {
    transform: translateX(-5px);
  }
  50% {
    transform: translateX(5px);
  }
}

</style>

<script lang="ts">
import axios from 'axios';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'whatsapp-verify',
    props: {
        token: String,
        acceptKey: String,
    },
    data() {
        return {
            code: '',
            error: '',
            isError: false,
            isRepeatedError: false,
            digits: [
                { id: 'digit-1', value: '', insert: '', next: 'digit-2' },
                { id: 'digit-2', value: '', insert: '', next: 'digit-3', previous: 'digit-1' },
                { id: 'digit-3', value: '', insert: '', next: 'digit-4', previous: 'digit-2' },
                { id: 'digit-4', value: '', insert: '', next: 'digit-5', previous: 'digit-3' },
                { id: 'digit-5', value: '', insert: '', next: 'digit-6', previous: 'digit-4' },
                { id: 'digit-6', value: '', insert: '', previous: 'digit-5' },
            ],
            resendCodeStatus: false,
            resendTimer: 60,
            isLoading: false,
            interval: null,
        };
    },
    created() {
        this.getCookie();
        this.getCode();
    },
    methods: {
        pasteCode(evt) {
            // Handle pasting code if needed
        },

        getCookie() {
            let cookie = this.$cookies.get('resend_timer_wa');
            if (cookie != null) {
                this.resendTimer = cookie;
                this.resendCodeStatus = true;
                this.startTimer();
            } else {
                this.resendTimer = 60;
                this.resendCodeStatus = false;
            }
        },

        async getCode() {
            try {
                const response = await axios.post('/api/candidate/get-code', {
                    token: this.token,
                    key: this.acceptKey,
                    receiver: this.$store.state.user.candidate_phone,
                });

                if (response.data.status === 200) {
                    this.code = response.data.code;
                } else {
                    this.$router.push('/verify-my-account');
                }
            } catch (error) {
                console.error(error);
                // Handle error
            }
        },

        async verifyUser(otp) {
            this.isLoading = true;
            try {
                const user = this.$store.state.user;
                const response = await axios.post('/api/candidate/verify-code', {
                    token: this.token,
                    key: this.acceptKey,
                    otp: otp,
                    slug: user.candidate_slug,
                    type: 'wa',
                });

                if (response.data.status === 200) {
                    this.isLoading = false;
                    this.$router.push('/');
                } else {
                    this.isLoading = false;
                    this.error = response.data.error;
                    this.isError == false ? (this.isError = true) : (this.isRepeatedError = true);
                    if (this.isRepeatedError) {
                        this.errorMessageShake();
                    }
                }
            } catch (error) {
                console.error(error);
                // Handle error
            }
        },

        async resendCode() {
            try {
                this.resendCodeStatus = true;
                let cookie = this.$cookies.get('resend_timer_wa');
                if (cookie != null) {
                    this.resendTimer = cookie;
                } else {
                    this.resendTimer = 60;
                }

                const response = await axios.post('/api/candidate/resend-code', {
                    token: this.token,
                    key: this.acceptKey,
                    receiver: this.$store.state.user.candidate_phone,
                    type: 'wa',
                });

                if (response.data.status === 200) {
                    this.getCode();
                } else {
                    this.error = response.data.error;
                    this.isError == false ? (this.isError = true) : (this.isRepeatedError = true);
                    if (this.isRepeatedError) {
                        this.errorMessageShake();
                    }
                }

                this.startTimer();
            } catch (error) {
                console.error(error);
                // Handle error
            }
        },

        startTimer() {
            this.interval = setInterval(() => {
                this.resendTimer--;
                this.$cookies.set('resend_timer_wa', this.resendTimer, '1d');
                if (this.resendTimer === 0) {
                    clearInterval(this.interval);
                    this.resendCodeStatus = false;
                    this.$cookies.remove('resend_timer_wa');
                }
            }, 1000);
        },

        handleInput() {
            this.digits.forEach((digit, index) => {
                if (digit.insert.length > 1) {
                    this.digits[index].insert = digit.insert.slice(0, 1);
                }
            });
        },

        handleKeyUp(id, event) {
            const index = this.digits.findIndex((digit) => digit.id == id);
            const value = event.target.value;

            if (event.keyCode === 8 || event.keyCode === 37) {
                const prevIndex = index > 0 ? index - 1 : null;
                this.focusInput(prevIndex, id, 'previous', index, value);
            } else if (
                (event.keyCode >= 48 && event.keyCode <= 57) ||
                (event.keyCode >= 65 && event.keyCode <= 90) ||
                (event.keyCode >= 96 && event.keyCode <= 105) ||
                event.keyCode === 39
            ) {
                const nextIndex = index < this.digits.length - 1 ? index + 1 : null;
                this.focusInput(nextIndex, id, 'next', index, value);
            }
        },

        focusInput(index, currentTarget, direction, currentIndex, value) {
            const input = document.getElementById(currentTarget);
            const dataNext = input?.getAttribute('data-next') || null;
            const dataPrevious = input?.getAttribute('data-previous') || null;
            const insertValueToTarget = this.digits[currentIndex];

            if (index !== null && direction === 'previous') {
                insertValueToTarget.value = value;
                const previousInput = document.getElementById(dataPrevious);
                if (previousInput) {
                    previousInput.focus();
                }
            } else if (index !== null && direction === 'next') {
                insertValueToTarget.value = value;
                const nextInput = document.getElementById(dataNext);
                if (nextInput) {
                    nextInput.focus();
                }
            } else {
                insertValueToTarget.value = value;
            }
        },

        verifyOtp() {
            this.isLoading = true;
            let otp = '';
            const errorMessage = document.getElementById('error-message');

            for (let i = 0; i < this.digits.length; i++) {
                otp += this.digits[i].value;
            }

            const length = otp.length;
            if (length < 6) {
                this.isLoading = false;
                this.error = 'Please enter a valid OTP';
                this.isError == false ? (this.isError = true) : (this.isRepeatedError = true);
                if (this.isRepeatedError) {
                    this.errorMessageShake();
                }
            } else {
                this.error = '';
                if (otp == this.code) {
                    this.error = '';
                    this.isError = false;
                    this.isRepeatedError = false;

                    this.verifyUser(otp);
                } else {
                    this.isLoading = false;
                    this.isError == false ? (this.isError = true) : (this.isRepeatedError = true);
                    this.error = 'Please enter a valid OTP';
                    if (this.isRepeatedError) {
                        this.errorMessageShake();
                    }
                }
            }
        },

        errorMessageShake() {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.classList.add('shake');
                setTimeout(() => {
                    errorMessage.classList.remove('shake');
                    this.isRepeatedError = false;
                }, 500);
            }
        },
    },
});
</script>