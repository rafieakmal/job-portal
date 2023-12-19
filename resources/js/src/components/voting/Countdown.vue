<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-center countdown">
                        <div>
                            <h3 v-show="loaded">{{displayDays}}</h3>
                            <h3 v-show="!loaded">...</h3>
                            <h4>Day(s)</h4>
                        </div>
                        <div>
                            <h3 v-show="loaded">{{displayHours}}</h3>
                            <h3 v-show="!loaded">...</h3>
                            <h4>Hour(s)</h4>
                        </div>
                        <div>
                            <h3 v-show="loaded">{{displayMinutes}}</h3>
                            <h3 v-show="!loaded">...</h3>
                            <h4>Minute(s)</h4>
                        </div>
                        <div>
                            <h3 v-show="loaded">{{displaySeconds}}</h3>
                            <h3 v-show="!loaded">...</h3>
                            <h4>Second(s)</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { EventBus } from '../../eventBus'
    export default {
        props: ['year', 'month', 'date', 'hour', 'minute', 'second'],
        data() {
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0,
                loaded: false,
                expired: false
            }
        },
        computed: {
            _seconds: () => 1000,
            _minutes() {
                return this._seconds * 60
            },
            _hours() {
                return this._minutes * 60
            },
            _days() {
                return this._hours * 24
            },
            end() {
                return new Date(
                    this.year,
                    this.month,
                    this.date,
                    this.hour,
                    this.minute,
                    this.second
                )
            }
        },
        created() {
            this.showRemaining()
        },
        methods: {
            emitTimerIsEnded() {
                this.loaded = true
                EventBus.$emit('timer_ended', this.expired);
            },
            emitTimerIsLoaded() {
                this.loaded = true
                EventBus.$emit('timer_loaded', this.expired);
            },
            showRemaining() {
                const timer = setInterval(() => {
                    const now = new Date()
                    // const end = new Date(2023, 3, 10, 10, 10, 10)
                    const distance = this.end.getTime() - now.getTime()
                    if(distance < 0) {
                        clearInterval(timer)
                        this.expired = true
                        this.emitTimerIsEnded()
                        return
                    }
                    const days = Math.floor(distance / this._days)
                    const hours = Math.floor((distance % this._days) / this._hours)
                    const minutes = Math.floor((distance % this._hours) / this._minutes)
                    const seconds = Math.floor((distance % this._minutes) / this._seconds)

                    this.displayMinutes = minutes < 10 ? "0" + minutes : minutes
                    this.displaySeconds = seconds < 10 ? "0" + seconds : seconds
                    this.displayHours = hours < 10 ? "0" + hours : hours
                    this.displayDays = days < 10 ? "0" + days : days
                    if (isNaN(this.displayMinutes)) this.displayMinutes = 0
                    if (isNaN(this.displaySeconds)) this.displaySeconds = 0
                    if (isNaN(this.displayHours)) this.displayHours = 0
                    if (isNaN(this.displayDays)) this.displayDays = 0
                    return this.emitTimerIsLoaded()
                }, 1000)
            }
        }
    }
</script>