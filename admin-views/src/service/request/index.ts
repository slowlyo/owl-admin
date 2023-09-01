import CustomAxiosInstance from "@/service/request/instance"
import config from "./config"


export const request = new CustomAxiosInstance(config).instance