import {Icon} from '@iconify/react'

const Card = ({children, selected}) => {
    return (
        <div className={'relative w-[100px] h-[60px] p-[5px] rounded cursor-pointer bg-white hover:shadow border'}>
            {selected && (
                <div className="absolute w-full h-full flex justify-center items-center mt-[-5px] ml-[-5px] rounded backdrop-blur-[3px] bg-white/20">
                    <Icon icon="mdi:check-bold" fontSize={20} className="text-primary"/>
                </div>
            )}
            {children}
        </div>
    )
}

const SelectLayout = ({current}) => {
    return (
        <div>
            <div className="flex justify-between">
                {/*default*/}
                <Card selected={current == 'default'}>
                    <div className="flex h-full">
                        <div className="bg-slate-500 w-[20px] h-full mr-[5px] rounded"></div>
                        <div className="flex-1 w-[60px] h-full flex flex-col">
                            <div className="bg-slate-500 h-[10px] mb-[5px] rounded"></div>
                            <div className="bg-slate-200 flex-1 rounded"></div>
                        </div>
                    </div>
                </Card>
                {/*top*/}
                <Card selected={current == 'top'}>
                    <div className="flex flex-col h-full">
                        <div className="bg-slate-500 h-[10px] mb-[5px] rounded"></div>
                        <div className="bg-slate-200 flex-1 rounded"></div>
                    </div>
                </Card>
            </div>
            <div className="flex justify-between mt-3">
                {/*top-mix*/}
                <Card selected={current == 'top-mix'}>
                    <div className="flex flex-col h-full">
                        <div className="bg-slate-500 h-[10px] mb-[5px] rounded"></div>
                        <div className="w-full flex">
                            <div className="bg-slate-500 w-[20px] h-auto mr-[5px] rounded"></div>
                            <div className="bg-slate-200 flex-1 h-[35px] rounded"></div>
                        </div>
                    </div>
                </Card>
                {/*double*/}
                <Card selected={current == 'double'}>
                    <div className="flex h-full">
                        <div className="bg-slate-500 w-[6px] h-auto mr-[5px] rounded"></div>
                        <div className="bg-slate-500 w-[16px] h-auto mr-[5px] rounded"></div>
                        <div className="flex-1 w-[60px] h-full flex flex-col">
                            <div className="bg-slate-500 h-[10px] mb-[5px] rounded"></div>
                            <div className="bg-slate-200 flex-1 rounded"></div>
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    )
}
export default SelectLayout
