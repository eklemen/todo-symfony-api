import React, { Component } from 'react';
import {connect} from 'react-redux';

import {getTodos, handleClick} from './actions/TodoActions';
import {TodoItem} from './components/'
export class MyTodo extends Component {

    componentDidMount(){
        this.props.dispatch(getTodos());
    }

    render() {
    	const {todos=[], dispatch} = this.props;
    	console.log(todos)
        return (
            <div>
                My Todos
                <button onClick={ event => dispatch(handleClick(event))}>Click me</button>
                <ul>
                    {
                        todos.map( todo => {
                            return (<TodoItem key={todo.id} data={todo} />);
                        })
                    }
                </ul>


                <section className="todoapp">
                    <header className="header">
                        <h1>todos</h1>
                        <input className="new-todo" placeholder="What needs to be done?" autoFocus />
                    </header>
                    <section className="main">
                        <input className="toggle-all" type="checkbox"/>
                        <label htmlFor="toggle-all">Mark all as complete</label>
                        <ul className="todo-list">
                            <li className="completed">
                                <div className="view">
                                    <input className="toggle" type="checkbox" checked onChange={()=>{}}/>
                                    <label>Taste JavaScript</label>
                                    <button className="destroy"></button>
                                </div>
                                <input className="edit" value="Create a TodoMVC template" onChange={()=>{}}/>
                            </li>
                            <li>
                                <div className="view">
                                    <input className="toggle" type="checkbox" onChange={()=>{}}/>
                                    <label>Buy a unicorn</label>
                                    <button className="destroy"></button>
                                </div>
                                <input className="edit" value="Rule the web" onChange={()=>{}}/>
                            </li>
                        </ul>
                    </section>
                    <footer className="footer">
                        <span className="todo-count"><strong>0</strong> item left</span>
                        <ul className="filters">
                            <li>
                                <a className="selected" href="#/">All</a>
                            </li>
                            <li>
                                <a href="#/active">Active</a>
                            </li>
                            <li>
                                <a href="#/completed">Completed</a>
                            </li>
                        </ul>
                        <button className="clear-completed">Clear completed</button>
                    </footer>
                </section>
                <footer className="info">
                    <p>Double-click to edit a todo</p>
                    <p>Template by <a href="http://sindresorhus.com">Sindre Sorhus</a></p>
                    <p>Created by <a href="http://todomvc.com">you</a></p>
                    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
                </footer>

            </div>
        );
    }
}

export const mapStateToProps = state => {
	return {
		todos: state.Todos.todoView.data
	}
}

export default connect(mapStateToProps)(MyTodo);


