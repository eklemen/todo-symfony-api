import {combineReducers} from "redux";
import TodosReducers from './MyTodo/reducers/';

export default combineReducers({
    Todos: TodosReducers
});
