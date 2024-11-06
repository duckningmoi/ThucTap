import axiosInstance from "../configs/axios";


//Danh mục
export interface Category {
  id: string;
  name: string;
  slug: string;
}


export const fetchCategorys = async (): Promise<Category[]> => {
  const response = await axiosInstance.get<Category[]>("/category");
  return response.data;
};



