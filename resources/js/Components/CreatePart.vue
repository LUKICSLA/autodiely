<template>
    <form @submit.prevent="submitForm">
        <div class="mb-3">
            <label for="name" class="form-label">Názov dielu</label>
            <input type="text" class="form-control" id="name" v-model="form.name" required>
        </div>

        <div class="mb-3">
            <label for="serialnumber" class="form-label">Serióve číslo</label>
            <input type="number" class="form-control" id="serialnumber" v-model="form.serialnumber" required>
        </div>

        <div class="mb-3">
            <label for="part_id" class="form-label">Diel</label>
            <select v-model="form.part_id" class="form-control">
                <option value="">Vyber diel</option>
                <option v-for="part in parts" :key="part.id" :value="part.id">
                    {{ part.name }} - {{ part.serialnumber }}
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Pridať diel</button>
        <a href="{{ route('parts.index') }}" class="btn btn-secondary">Späť</a>
    </form>
</template>

<script>
export default {
    props: ['parts'],
    data() {
        return {
            form: {
                name: '',
                serialnumber: '',
                part_id: ''
            }
        };
    },
    methods: {
        submitForm() {
            axios.post('/parts', this.form)
                .then(response => {
                    window.location.href = '/parts';
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
