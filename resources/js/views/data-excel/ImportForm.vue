<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          Import excel form
        </div>
        <el-form ref="dataExcel" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex">
            <el-form-item
              data-generator="importFile"
              :error="errors.avatar && errors.avatar[0]"
              label="File Upload"
              prop="importFile"
            >
              <el-input id="importFile" ref="importFile" v-model="form.importFile" type="file"></el-input>
            </el-form-item>
          </el-form-item>
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'DataExcel' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('dataExcel')"
              >
                Import Excel
              </el-button>
            </template>
          </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import GlobalForm from '@/plugins/mixins/global-form';
import DataExcelResource from '@/api/v1/data-excel';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const dataExcelResource = new DataExcelResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        importFile: '',
      }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    // dataExcelResource.export().then(res => {
    //   console.log(res);
    // });
  },
  async mounted() {
    // dataExcelResource.export().then(res => {
    //   console.log(res);
    //   });
  },
  methods: {
    handleAvatarSuccess(res, file) {
      this.form.importFile = URL.createObjectURL(file.raw);
    },
    store(dataExcel) {
      this.$refs[dataExcel].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          const loading = this.$loading({
            lock: true,
            text: 'Uploading...',
            spinner: 'el-icon-loading',
            background: 'rgba(0, 0, 0, 0.7)',
          });

          try {
            const file = document.querySelector('#importFile').files[0];
            if (file === undefined) {
              this.$message({
                showClose: true,
                message: 'undefined',
                type: 'error',
              });
            }
            const formData = new FormData();
            formData.set('importFile', file);
            dataExcelResource.import(formData);
            setTimeout(() => {
              loading.close();
              this.$router.push({ name: 'DataExcelBatch' });
            }, 10000);
          } catch (e) {
            loading.text = e;
            setTimeout(() => {
              loading.close();
            }, 3000);
          }
        });
      });
    },
  },
};
</script>
