<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.building_edit') }}
          </template>
          <template v-else>
            {{ $t('route.building_create') }}
          </template>
        </div>
        <el-form ref="building" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-form-item
          data-generator="name"
          :label="$t('table.building.name')"
          prop="name"
          :error="errors.name && errors.name[0]"
          >
            <el-input
              v-model="form.name"
              name="name"
              :placeholder="$t('table.building.name')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
          data-generator="address"
          :label="$t('table.building.address')"
          prop="address"
          :error="errors.address && errors.address[0]"
          >
            <el-input
              v-model="form.address"
              name="address"
              :placeholder="$t('table.building.address')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <el-form-item
          data-generator="status"
          :label="$t('table.building.status')"
          prop="status"
          :error="errors.status && errors.status[0]"
          >
						<el-input-number
						  v-model="form.status"
						  name="status"
						  :placeholder="$t('table.building.status')"
            />
					</el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Building' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button
                :loading="loading.button"
                type="primary"
                icon="el-icon-edit"
                @click="() => update('building')"
              >
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button
                :loading="loading.button"
                type="success"
                icon="el-icon-plus"
                @click="() => store('building')"
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
import BuildingResource from '@/api/v1/building';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const buildingResource = new BuildingResource();

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
        address: '',
        status: '',
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
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.building.name') }), trigger: ['change'] },
        ],
        address: [
          { required: true, message: this.$t('validation.required', { attribute: this.$t('table.building.address') }), trigger: ['change'] },
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
          data: { data: building },
        } = await buildingResource.get(id);
        this.form = building;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(building) {
      this.$refs[building].validate((valid, errors) => {
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
            await buildingResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Building' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(building) {
      this.$refs[building].validate((valid, errors) => {
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
            await buildingResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Building' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
