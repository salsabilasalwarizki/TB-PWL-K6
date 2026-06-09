#include <iostream>
#include <fstream>
using namespace std;

int main()
{
    fstream file;
    file.open("pertemuan3_1.txt", ios::out); //membuat file baru, jika file sudah ada maka akan menimpa file tersebut
    file << "Ini adalah file txt pertama" << endl;
    file.close();

    file.open("pertemuan3_1.txt", ios::app); //menambahkan teks tanpa menimpa teks sebelumnya
    file << "Ini adalah baris pertama dari file txt pertama" << endl;
    file.close();

    file.open("pertemuan3_1.txt", ios::in); //membaca file, jika file tidak ada maka akan error
    string txt;
    while(getline(file, txt))
    {
        cout << txt << endl;
    }
    file.close();
    return 0;
}