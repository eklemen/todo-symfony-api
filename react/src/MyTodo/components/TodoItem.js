import React, { Component } from 'react';

export class TodoItem extends Component {

    render() {
    	const { data } = this.props;
    	const isCompleted = data.is_completed 
    		? <p>complete</p> 
    		: <p>incomplete</p>;
        return (
            <div>
                <span>{data.task}</span>
                <span>{isCompleted}</span>
            </div>
        );
    }
}

export default TodoItem;