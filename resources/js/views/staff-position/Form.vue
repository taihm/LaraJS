<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.staff_position_edit') }}
          </template>
          <template v-else>
            {{ $t('route.staff_position_create') }}
          </template>
        </div>
        <el-form ref="staffPosition" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-form-item
          data-generator="name"
          :label="$t('table.staff_position.name')"
          prop="name"
          :error="errors.name && errors.name[0]"
          >
            <el-input
              v-model="form.name"
              name="name"
              :placeholder="$t('table.staff_position.name')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
          data-generator="description"
          :label="$t('table.staff_position.description')"
          prop="description"
          :error="errors.description && errors.description[0]"
          >
            <el-input
              v-model="form.description"
              name="description"
              :placeholder="$t('table.staff_position.description')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'StaffPosition' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('staffPosition')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('staffPosition')"
              >
                {{ $t('button.create') }}
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
import StaffPositionResource from '@/api/v1/staff-position';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const staffPositionResource = new StaffPositionResource();

export default {
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        id: '',
        name: '',
        description: '',
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
        name: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.staff_position.name') }), trigger: ['change'] },
        ],
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: staffPosition },
        } = await staffPositionResource.get(id);
        this.form = staffPosition;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(staffPosition) {
      this.$refs[staffPosition].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await staffPositionResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'StaffPosition' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(staffPosition) {
      this.$refs[staffPosition].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.update'), {
          confirmButtonText: this.$t('button.update'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await staffPositionResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'StaffPosition' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
