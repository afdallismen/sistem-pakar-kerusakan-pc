import { stringify } from 'query-string'

import { instance as axios, wrapHttpError } from './axios'

const dataProvider = {
  getList: async (resource, params) => {
    const { page, perPage } = params.pagination
    const { field, order } = params.sort
    const query = {
      'sort': field,
      'order': order,
      'page': page,
      'perPage': perPage,
    }

    Object.keys(params.filter).forEach(key => {
      query[key] = params.filter[key]
    });
    
    const url = `/api/${resource}?${stringify(query)}`

    return await wrapHttpError(
      axios.get(url)
    )
  },
  getOne: async (resource, { id }) => {
    return await wrapHttpError(
      axios.get(`/api/${resource}/${id}`)
    )
  },
  getMany: async (resource, { ids }) => {
    return await wrapHttpError(
      axios.get(`/api/${resource}?ids=${ids}`)
    )
  },
  getManyReference: async () => {},
  create: async (resource, { data }) => {
    return await wrapHttpError(
      axios.post(`/api/${resource}`, data)
    )
  },
  update: async (resource, { id, data }) => {
    return await wrapHttpError(
      axios.put(`/api/${resource}/${id}`, data)
    )
  },
  updateMany: async () => {},
  delete: async (resource, { id }) => {
    return await wrapHttpError(
      axios.delete(`/api/${resource}/${id}`)
    )
  },
  deleteMany: async (resource, { ids }) => {
    return await wrapHttpError(
      axios.delete(`/api/${resource}/bulk?ids=${ids}`)
    )
  },
}

export default dataProvider
