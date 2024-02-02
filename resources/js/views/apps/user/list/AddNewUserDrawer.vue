<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'

const props = defineProps({
  isDrawerOpen: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDrawerOpen',
  'userData',
])

const isFormValid = ref(false)
const refForm = ref()
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const gender = ref('')
const level = ref('')
const position = ref('')
const department = ref('')
const role = ref('')

// 👉 drawer close
const closeNavigationDrawer = () => {
  emit('update:isDrawerOpen', false)
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = () => {
  refForm.value?.validate().then(({ valid }) => {
    if (valid) {
      emit('userData', {
        firstname: firstName.value,
        lastname: lastName.value,
        email: email.value,
        gender: gender.value,
        level: level.value,
        position: position.value,
        department: department.value,
        role: role.value,
      })
      emit('update:isDrawerOpen', false)
      nextTick(() => {
        refForm.value?.reset()
        refForm.value?.resetValidation()
      })
    }
  })
}

const handleDrawerModelValueUpdate = val => {
  emit('update:isDrawerOpen', val)
}
</script>

<template>
  <VNavigationDrawer
    temporary
    :width="400"
    location="end"
    class="scrollable-content"
    :model-value="props.isDrawerOpen"
    @update:model-value="handleDrawerModelValueUpdate"
  >
    <!-- 👉 Title -->
    <AppDrawerHeaderSection
      title="Add User"
      @cancel="closeNavigationDrawer"
    />

    <PerfectScrollbar :options="{ wheelPropagation: false }">
      <VCard flat>
        <VCardText>
          <!-- 👉 Form -->
          <VForm
            ref="refForm"
            v-model="isFormValid"
            @submit.prevent="onSubmit"
          >
            <VRow>
              <!-- 👉 First name -->
              <VCol cols="12">
                <AppTextField
                  v-model="firstName"
                  :rules="[requiredValidator]"
                  label="First Name"
                  placeholder="John Doe"
                />
              </VCol>

              <!-- 👉 Last name -->
              <VCol cols="12">
                <AppTextField
                  v-model="lastName"
                  :rules="[requiredValidator]"
                  label="Last Name"
                  placeholder="John Doe"
                />
              </VCol>

              <!-- 👉 Email -->
              <VCol cols="12">
                <AppTextField
                  v-model="email"
                  :rules="[requiredValidator, emailValidator]"
                  label="Email"
                  placeholder="johndoe@email.com"
                />
              </VCol>

              <!-- 👉 Gender -->
              <VCol cols="12">
                <AppSelect
                  v-model="gender"
                  label="Select Gender"
                  placeholder="Select Gender"
                  :rules="[requiredValidator]"
                  :items="[
                    { title: 'Male', value: 'male' },
                    { title: 'Female', value: 'female' },
                  ]"
                />
              </VCol>

              <!-- 👉 Level -->
              <VCol cols="12">
                <AppSelect
                  v-model="level"
                  label="Select Level"
                  placeholder="Select Level"
                  :rules="[requiredValidator]"
                  :items="['Chef', 'Manager', 'Staff']"
                />
              </VCol>

              <!-- 👉 Position -->
              <VCol cols="12">
                <AppSelect
                  v-model="position"
                  label="Select Position"
                  placeholder="Select Position"
                  :rules="[requiredValidator]"
                  :items="['Sale', 'HR', 'Staff']"
                />
              </VCol>
                
              <!-- 👉 Department -->
              <VCol cols="12">
                <AppSelect
                  v-model="department"
                  label="Select Department"
                  placeholder="Select Department"
                  :rules="[requiredValidator]"
                  :items="['Sale', 'Accounting', 'Operation']"
                />
              </VCol>

              <!-- 👉 Role -->
              <VCol cols="12">
                <AppSelect
                  v-model="role"
                  label="Select Role"
                  placeholder="Select Role"
                  :rules="[requiredValidator]"
                  :items="['Admin', 'Author', 'Editor', 'Maintainer', 'Subscriber']"
                />
              </VCol>

              <!-- 👉 Submit and Cancel -->
              <VCol cols="12">
                <VBtn
                  type="submit"
                  class="me-3"
                >
                  Submit
                </VBtn>
                <VBtn
                  type="reset"
                  variant="outlined"
                  color="secondary"
                  @click="closeNavigationDrawer"
                >
                  Cancel
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </PerfectScrollbar>
  </VNavigationDrawer>
</template>
