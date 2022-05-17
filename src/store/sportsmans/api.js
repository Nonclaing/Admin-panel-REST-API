import Api from '@/api/index';

class Sportsmans extends Api {

  /**
   * Вернет список всех Спортсменов
   * @returns {Promise<Response>}
   */
  sportsmans = () => this.rest('/sportsmans/get-list.json', {
        method: 'GET',
        'Content-Type': 'application/json',
      });

  /**
   * Вернет фильтрованный список всех Спортсменов
   * @returns {Promise<Response>}
   */
  sportsmansFiltered = (filter_field, filter_value) => this.rest(
      `/sportsmans/get-list.json?filter[${filter_field}]=${filter_value}`,
      {
        method: 'GET',
        'Content-Type': 'application/json',
      });

  /**
   * Удалит Спортсмена по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/sportsmans/delete.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then((response) => response.json()).then((resJson) => resJson)

  /**
   * Создаст новую запись в таблице
   * @param sportsman объект спортсмена, взятый из FormSportsmans
   * @returns {Promise<Response>}
   */
  add = ( sportsman ) => this.rest('/sportsmans/add.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(sportsman),
  }).then((response) => response.json()).then((resJson) => resJson)

  /**
   * Отправит измененную запись
   * @param sportsman объект спортсмена, взятый из FormSportsmans
   * @returns {Promise<*>}
   */
  update = ( sportsman ) => this.rest('/sportsmans/update.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(sportsman),
  }).then((response) => response.json()).then((resJson) => resJson)

}

export default new Sportsmans();
