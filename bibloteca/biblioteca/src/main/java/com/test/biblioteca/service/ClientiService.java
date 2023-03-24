package com.test.biblioteca.service;
import com.test.biblioteca.entity.Clienti;
import java.util.List;
public interface ClientiService {
    //GET(READ)
    Clienti getid(Long id);
    List<Clienti>getallclienti();
    //POST(CREATE)
    Clienti addclienti(Clienti newclienti);
    //PUT(UPDATE)
    Clienti updateclienti(Clienti updatedclienti);
    //DELETE(DELETE)
    boolean deleteclienti(Long id);

}
