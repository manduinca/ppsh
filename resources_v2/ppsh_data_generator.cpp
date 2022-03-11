#include <mysql++/mysql++.h>
#include <iostream>
#include <fstream>
#include <sstream>
#include <string>
#include <cstdlib>
#include <cstring>
#include <vector>
#include <iterator>
                  //Número de puntos tomados por cada Periodo
#define LIMIT1 42 //Miguel(ZER) define esto, depende del archivo a entregar
#define LIMIT2 20

using namespace std;

vector < pair <float,float> > coordenadas;
vector < vector <int> > poligonos;

void leer_data() {
	ifstream f1, f2;

	f1.open("coordinates.txt", fstream::in);
	while(!f1.eof()){
		float x, y;
		f1 >> x >> y;
		coordenadas.push_back(make_pair(x, y));
	}
	f1.close();

	f2.open("polygons.txt", fstream::in);
	string str;
	while(getline(f2, str)) {
		istringstream iss(str);
		vector <string> tokens;
		copy(istream_iterator <string> (iss), istream_iterator <string> (), back_inserter <vector <string> > (tokens));
		vector <int> tmp;
		for(int i = 0; i < tokens.size(); i++)
			tmp.push_back(atoi(tokens[i].c_str()) - 1);
		poligonos.push_back(tmp);
	}
	f2.close();
}

bool isInsidePoligon(pair<float,float>p, int k){
    int nvert = poligonos[k].size();
    float testy = p.first;
    float testx = p.second;
    vector<float> vertx;
    vector<float> verty;
    for(int t = 0; t < poligonos[k].size(); t++){
        verty.push_back(coordenadas[poligonos[k][t]].first);
        vertx.push_back(coordenadas[poligonos[k][t]].second);
    }
    int i, j, c = 0;
    for (i = 0, j = nvert-1; i < nvert; j = i++) {
        if( ((verty[i]>testy) != (verty[j]>testy)) &&
            (testx < (vertx[j]-vertx[i]) * (testy-verty[i]) / (verty[j]-verty[i]) + vertx[i]) ){
            c = !c;
        }
    }
    return c;
}

int getPoligono(pair <float, float> c){
	for(int i = 0; i < poligonos.size(); i++){
		int x = isInsidePoligon(c, i);
		if(x)
			return i;
	}
	return -1;
}

void lectura_coordenadas() {
	ifstream F;
	string tstr;
	double lat, lon, T;
    int bas;
    mysqlpp::Connection conn(false);

    char server[] = "db";
    char user[] = "root";
    char pass[] = "123456";

    conn.connect(NULL, server, user, pass);
    conn.select_db("devel_sencico");
    mysqlpp::Query query = conn.query();

	F.open("Pond0_Ltc_short.gra", fstream::in);

    int con = 0;
	while(getline(F, tstr)) {
        string line = tstr.substr(0, 4);
        if(line.compare("Site") == 0) {
            con++;
            sscanf(tstr.c_str(), "Site: %lf %lf", &lon, &lat);
            int p = getPoligono(make_pair(lat, lon));
            cout << p << " ";
            if(p == -1) {con--; continue;}
            //query << "INSERT INTO location VALUES (" << con << ", " << lat << ", " << lon << ", " << p << ");";
			string tabla = "zer" + to_string(p);
           // if(!query.execute())
           //     cout << query.error() << endl;
            for(int j = 0; j < LIMIT1; j++) {
                getline(F, tstr);
                sscanf(tstr.c_str(), "Intensity %d   T=%lf", &bas, &T);
                getline(F, tstr);
                for(int i = 0; i < LIMIT2; i++) {
                    getline(F, tstr);
                    double x, y;
                    sscanf(tstr.c_str(), "%lf %lf", &x, &y);
					//cout << T << " " << x << " " << y << " " << con << endl;
                    //query << "INSERT INTO " << tabla << " VALUES (" << con << ", " << T << ", " << x << ", " << y << ");";
                    //if(!query.execute())
                        //cout << query.error() << endl;
                }
            }
        }
	}

	F.close();
}

int main(int argc, char *argv[]){
    leer_data();
    lectura_coordenadas();
    return 0;
}
