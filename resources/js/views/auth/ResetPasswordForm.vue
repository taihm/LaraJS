<template>
  <el-container class="tw-blue-grey tw-lighten-5 tw-h-screen tw-justify-center tw-items-center">
    <el-row class="reset-password">
      <el-col :xs="24" :sm="24" :lg="24" :xl="24">
        <el-card>
          <div slot="header" class="tw-text-center">
            {{ $t('auth.reset_password') }}
          </div>
          <div>
            <el-form ref="resetForm" :model="form" :rules="rules">
              <el-form-item
                data-generator="password"
                required
                :label="$t('table.user.password')"
                :error="errors.password && errors.password[0]"
                prop="password"
              >
                <el-input v-model="form.password" show-password type="password" />
              </el-form-item>
              <el-form-item
                data-generator="password_confirmation"
                required
                :label="$t('table.user.password_confirmation')"
                prop="password_confirmation"
              >
                <el-input v-model="form.password_confirmation" show-password type="password" />
              </el-form-item>
              <el-form-item class="tw-text-center">
                <el-button
                  v-loading.fullscreen.lock="loadingResetPassword"
                  type="primary"
                  icon="el-icon-check"
                  circle
                  @click="resetPassword('resetForm')"
                />
              </el-form-item>
            </el-form>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </el-container>
</template>

<script>
import { callResetPassword } from '@/api/v1/auth';

export default {
  data() {
    const password = (rule, value, cb) => {
      if (value === '') {
        cb(
          new Error(
            this.$t('validation.required', {
              attribute: this.$t('table.user.password'),
            })
          )
        );
      } else {
        let messagePassword = '';
        switch (false) {
          case /[a-z]+/.test(value):
            messagePassword = this.$t('validation.password.lowercase', {
              attribute: this.$t('table.user.password'),
              number: 1,
            });
            break;
          case /[A-Z]+/.test(value):
            messagePassword = this.$t('validation.password.uppercase', {
              attribute: this.$t('table.user.password'),
              number: 1,
            });
            break;
          case /[0-9]+/.test(value):
            messagePassword = this.$t('validation.password.number', {
              attribute: this.$t('table.user.password'),
              number: 1,
            });
            break;
          case /[!@#$%^&*]+/.test(value):
            messagePassword = this.$t('validation.password.symbols', {
              attribute: this.$t('table.user.password'),
              number: 1,
            });
            break;
        }
        if (messagePassword) {
          return cb(messagePassword);
        }
        if (this.form.password_confirmation !== '') {
          this.$refs.resetForm.validateField('password_confirmation');
        }
        cb();
      }
    };
    const passwordConfirm = (rule, value, cb) => {
      if (value === '') {
        cb(
          new Error(
            this.$t('validation.required', {
              attribute: this.$t('table.user.password_confirmation'),
            })
          )
        );
      } else if (value !== this.form.password) {
        cb(
          new Error(
            this.$t('validation.confirmed', {
              attribute: this.$t('table.user.password_confirmation'),
            })
          )
        );
      } else {
        cb();
      }
    };
    return {
      form: {
        token: this.$route.params.token,
        password: '',
        password_confirmation: '',
      },
      loadingResetPassword: false,
      rules: {
        password: [
          { validator: password, trigger: ['change', 'blur'] },
          {
            min: 8,
            message: this.$t('validation.min.string', {
              attribute: this.$t('table.user.password'),
              min: 8,
            }),
            trigger: ['change', 'blur'],
          },
        ],
        password_confirmation: [{ validator: passwordConfirm, trigger: ['change', 'blur'] }],
      },
    };
  },
  methods: {
    resetPassword(nameForm) {
      this.$refs[nameForm].validate(valid => {
        if (!valid) {
          return false;
        }
        this.loadingResetPassword = true;
        callResetPassword(this.form)
          .then(res => {
            this.$router.replace({ name: 'Login' });
            this.$message({
              showClose: true,
              message: res.data.message,
              type: 'success',
            });
            this.loadingResetPassword = false;
          })
          .catch(() => {
            this.loadingResetPassword = false;
          });
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.reset-password {
  width: 50rem;
}
</style>
