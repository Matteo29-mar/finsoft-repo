package com.bibloteca.clienti;
import com.bibloteca.clienti.controller.Clienticontroller;
import com.bibloteca.clienti.entity.Clienti;

import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.WebMvcTest;
import org.springframework.boot.test.mock.mockito.MockBean;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.test.context.junit4.SpringRunner;

import static org.hamcrest.Matchers.equalTo;
import static org.mockito.BDDMockito.*;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.get;
import static org.hamcrest.collection.IsCollectionWithSize.hasSize;
import static org.hamcrest.core.Is.is;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

import org.junit.jupiter.api.Test;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.request.MockMvcRequestBuilders;
import org.springframework.web.server.ResponseStatusException;

import java.net.URI;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;;
@RunWith(SpringRunner.class)
@WebMvcTest(Clienticontroller.class)
class ClientiApplicationTests {

	@Autowired
	private MockMvc mvc;

	@MockBean
	private Clienticontroller controller;
	Clienti clienti_1 = new Clienti(1L, "Mario", "Luigi", "mariolu@gmail.com", "1234567890", "05-06-1987");
	String clienti1_json ="{\"id_cliente\":1,\"nome\":\"mario\",\"cognome\":\"luigi\",\"email\":\"mariolu@gmail.com\",\"telefono\":\"1234567890\",\"data_nascita\":\"05-06-1987\"}";

	String clienti_1_updated_json = "{\"id_cliente\":1,\"nome\":\"mario\",\"cognome\":\"luigi\",\"email\":\"mariolu@gmail.com\",\"telefono\":\"9876543210\",\"data_nascita\":\"05-06-1987\"}";
	Clienti clienti_1_updated = new Clienti(1L, "Mario", "Luigi", "mariolu@gmail.com", "9876543210", "05-06-1987" );
	@Test
	void AddClienti()  throws Exception{
		given(controller.AddClienti(clienti_1)).willReturn(ResponseEntity.created(new URI("/" + clienti_1.getId_cliente())).body(clienti_1));
		mvc.perform(MockMvcRequestBuilders.post(new URI("/api/r1/clienti"))
						.accept(MediaType.APPLICATION_JSON)
						.content(clienti1_json)
						.contentType(MediaType.APPLICATION_JSON))
				.andExpect(status().isCreated());

	}
	@Test
	void GetId() throws Exception{

		given(controller.GetId(clienti_1.getId_cliente())).willReturn(ResponseEntity.ok(clienti_1));
		mvc.perform(MockMvcRequestBuilders.get(new URI("/api/r1/" +  clienti_1.getId_cliente()))
						.contentType(MediaType.APPLICATION_JSON))
				.andExpect(status().isOk())
				.andExpect(jsonPath("nome", is(clienti_1.getNome())));
	}
	@Test
	void GetAllClienti() throws Exception{
		List<Clienti> allClienti = new ArrayList<>(Arrays.asList(clienti_1));
		given(controller.GetAllClienti()).willReturn(allClienti);
		mvc.perform(MockMvcRequestBuilders.get(new URI("/api/r1"))
						.contentType(MediaType.APPLICATION_JSON))
				.andExpect(status().isOk())
				.andExpect(jsonPath("$", hasSize(1)))
				.andExpect(jsonPath("$[0].nome", is(clienti_1.getNome())));

	}
	@Test
	void UpdateClienti()  throws Exception{
		clienti_1_updated.setId_cliente(clienti_1.getId_cliente());
		given(controller.Update_Clienti(clienti_1.getId_cliente(),clienti_1_updated)).willReturn(ResponseEntity.noContent().build());
		mvc.perform(MockMvcRequestBuilders.put(new URI("/api/r1/" + clienti_1.getId_cliente()))
						.contentType(MediaType.APPLICATION_JSON)
						.content(clienti_1_updated_json))
				.andExpect(status().isNoContent());
	}
	@Test
	void DeleteClientiId() throws Exception{
		given(controller.DeleteClientiId(clienti_1.getId_cliente())).willReturn(ResponseEntity.noContent().build());
		mvc.perform(MockMvcRequestBuilders.delete(new URI("/api/r1/clienti/" + clienti_1.getId_cliente())))
				.andExpect(status().isNoContent());
	}


}

