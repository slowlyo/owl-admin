import {useState} from 'react'
import {Button, DatePicker} from 'antd'

function App() {
    const [count, setCount] = useState(0)

    return (
        <>
            <DatePicker/>
            <div className="card">
                <Button onClick={() => setCount((count) => count + 1)}>
                    count is {count}
                </Button>
            </div>

        </>
    )
}

export default App
