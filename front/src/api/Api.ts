import axios from 'axios';
// import url from "@/helper/url";

export default class Api {
  protected url: string;

  constructor(url: string) {
    this.url = url;
    console.log("load API");
  }

  getUrl() {
    return this.url;
  }

  /**
   * Retorna todos os items
   * @returns {Promise<T|{description: *, error: *, status: boolean}|*>}
   */
  async getAll(filter = {}) {
    try {
        // console.log('url ->>>>', this.url);        
      const filterUrl = this.getFilterURL(filter);
      return await axios.get(`${this.url}?${filterUrl}`).then((res) => ({
        status: true,
        data: res.data,
      })).catch((err) =>
        ({
          status: false,
          error: err.message,
          description: err.response.data.message,
        }));
    } catch (error) {
        console.log(error);
      return error;
    }
  }

  /**
   * Retorna apenas um item da entidade
   * Show
   * @param id
   */
  async find(id: number | string) {
    try {
      return await axios.get(`${this.url}/${id}`).then((res) => ({
        status: res.status,
        data: res.data,
      })).catch((err) =>
        ({
          status: false,
          error: err.message,
          description: err.response.data.message,
        }));
    } catch (error) {
      return {
        status: false,
        error,
        description: null,
      };
    }
  }

  /**
   * Update de entidade
   * @param id
   * @param data
   * @returns {Promise<{data: any, message: *, status: boolean}|{error: *, message: *, status: boolean}|*>}
   */
  async update(id: string|number, data: any) {
    try {
      return await axios
        .put(`${this.url}/${id}`, data)
        .then((res: any) => this.success(res))
        .catch((err) => this.fail(err));
    } catch (error) {
      return error;
    }
  }

  /**
   * Salvando entidade
   * @param data
   * @returns {Promise<{data: any, status: boolean}|{description: *, error: *, status: boolean}|*>}
   */
  async save(data: any) {
    try {
      return await axios
        .post(this.url, data)
        .then((res: any) => this.success(res))
        .catch((err) => this.fail(err));
    } catch (error) {
      return error;
    }
  }

  /**
   * Deletando entidade
   * @param id
   * @returns {Promise<T|T>}
   */
  async destroy(id: number) {    
    return await axios.delete(`${this.url}/${id}`).then(res => {
        if (res.data.type === 'success') {            
            return {
                status: true,
                ok: true
            };
        } else {
            return {
                status: false,
                ok: false
            };
        }
    }).catch(err => {
        console.log(err)
    });      
  }; 


  async get(uri: string) {  
    return await axios.get(`${this.url}${uri}`);
  }

  async success(success: any) {
    return {
      ok: true,
      ...success,
    };
  } 

  fail(error: any) {
    return {
      ok: false,
      error,
    }
  }

  getFilterURL(data) {
    let url = "";
    Object.keys(data).map((objectKey, index) => {
      var value = data[objectKey];
      if (value) {
        url += value ? `&${objectKey}=${encodeURI(value)}` : "";
      }
    });
    return url;
  }
}
