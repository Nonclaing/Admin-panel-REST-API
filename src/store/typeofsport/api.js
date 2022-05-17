import Api from '@/api/index';

class TypeOfSport extends Api {

  /**
   * Вернет список всех видов спорта
   * @returns {Promise<Response>}
   */
  typeOfSport = () => this.rest('/typeofsports/get-list.json', {
    method: 'GET',
    'Content-Type': 'application/json',
  });

  typeOfSportFiltered = (filter_field, filter_id) => this.rest(
      `/typeofsports/get-list.json?filter[${filter_field}=${filter_id}]`, {
        method: 'GET',
        'Content-Type': 'application/json',
      });

  /**
   * Удалит вид спорта по id
   * @param id
   * @returns {Promise<*>}
   */
  remove = ( id ) => this.rest('/typeofsports/delete.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify({ id }),
  }).then((response) => response.json()).then((resJson) => resJson)

  /**
   * Создаст новую запись в таблице
   * @param TypeOfSport объект вида спорта, взятый из TypeOfSportGroup
   * @returns {Promise<Response>}
   */
  add = ( TypeOfSport ) => this.rest('/typeofsports/add.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(TypeOfSport),
  }).then((response) => response.json()).then((resJson) => resJson)

  /**
   * Отправит измененную запись
   * @param TypeOfSport объект вида спорта, взятый из TypeOfSportGroup
   * @returns {Promise<*>}
   */
  update = ( TypeOfSport ) => this.rest('/typeofsports/update.json', {
    method: 'POST',
    'Content-Type': 'application/json',
    body: JSON.stringify(TypeOfSport),
  }).then((response) => response.json()).then((resJson) => resJson)

}

export default new TypeOfSport();
